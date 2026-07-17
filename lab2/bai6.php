<?php
session_start();

// Gắn sẵn 3 tài khoản cứng khi chạy lần đầu
if (!isset($_SESSION["accounts"])) {
    $_SESSION["accounts"] = [
        [
            "accountNumber" => "1001",
            "ownerName" => "Nguyen Van A",
            "balance" => 5000000
        ],
        [
            "accountNumber" => "1002",
            "ownerName" => "Tran Thi B",
            "balance" => 3000000
        ],
        [
            "accountNumber" => "1003",
            "ownerName" => "Le Van C",
            "balance" => 7000000
        ]
    ];
}

// Class tài khoản ngân hàng
class BankAccount {
    private $accountNumber;
    private $ownerName;
    private $balance;

    public function __construct($accountNumber, $ownerName, $balance) {
        $this->accountNumber = $accountNumber;
        $this->ownerName = $ownerName;
        $this->balance = $balance;
    }

    public function deposit($amount) {
        if ($amount <= 0) {
            return "Số tiền nạp phải lớn hơn 0.";
        }

        $this->balance += $amount;
        return "Nạp tiền thành công.";
    }

    public function withdraw($amount) {
        if ($amount <= 0) {
            return "Số tiền rút phải lớn hơn 0.";
        }

        if ($amount > $this->balance) {
            return "Rút tiền thất bại. Số dư không đủ.";
        }

        $this->balance -= $amount;
        return "Rút tiền thành công.";
    }

    public function toArray() {
        return [
            "accountNumber" => $this->accountNumber,
            "ownerName" => $this->ownerName,
            "balance" => $this->balance
        ];
    }
}

// Class hệ thống quản lý tài khoản ngân hàng
class BankSystem {
    private $accounts;

    public function __construct(&$accounts) {
        $this->accounts = &$accounts;
    }

    public function addAccount($accountNumber, $ownerName, $balance) {
        if ($accountNumber == "" || $ownerName == "") {
            return "Vui lòng nhập đầy đủ số tài khoản và tên chủ tài khoản.";
        }

        if ($balance < 0) {
            return "Số dư ban đầu không được âm.";
        }

        foreach ($this->accounts as $account) {
            if ($account["accountNumber"] == $accountNumber) {
                return "Số tài khoản đã tồn tại.";
            }
        }

        $newAccount = new BankAccount($accountNumber, $ownerName, $balance);
        $this->accounts[] = $newAccount->toArray();

        return "Tạo tài khoản mới thành công.";
    }

    public function depositMoney($accountNumber, $amount) {
        foreach ($this->accounts as $index => $item) {
            if ($item["accountNumber"] == $accountNumber) {
                $account = new BankAccount(
                    $item["accountNumber"],
                    $item["ownerName"],
                    $item["balance"]
                );

                $message = $account->deposit($amount);
                $this->accounts[$index] = $account->toArray();

                return $message;
            }
        }

        return "Không tìm thấy tài khoản.";
    }

    public function withdrawMoney($accountNumber, $amount) {
        foreach ($this->accounts as $index => $item) {
            if ($item["accountNumber"] == $accountNumber) {
                $account = new BankAccount(
                    $item["accountNumber"],
                    $item["ownerName"],
                    $item["balance"]
                );

                $message = $account->withdraw($amount);
                $this->accounts[$index] = $account->toArray();

                return $message;
            }
        }

        return "Không tìm thấy tài khoản.";
    }

    public function displayAccounts() {
        $html = "";

        foreach ($this->accounts as $index => $account) {
            $stt = $index + 1;
            $accountNumber = htmlspecialchars($account["accountNumber"]);
            $ownerName = htmlspecialchars($account["ownerName"]);
            $balance = number_format($account["balance"], 0, ",", ".");

            $html .= "
                <tr>
                    <td>$stt</td>
                    <td>$accountNumber</td>
                    <td>$ownerName</td>
                    <td>$balance VNĐ</td>
                </tr>
            ";
        }

        return $html;
    }
}

$bankSystem = new BankSystem($_SESSION["accounts"]);
$message = "";
$alertClass = "alert-success";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"];

    if ($action == "create") {
        $accountNumber = trim($_POST["accountNumber"]);
        $ownerName = trim($_POST["ownerName"]);
        $balance = (float)$_POST["balance"];

        $message = $bankSystem->addAccount($accountNumber, $ownerName, $balance);
    }

    if ($action == "deposit") {
        $accountNumber = $_POST["selectedAccount"];
        $amount = (float)$_POST["amount"];

        $message = $bankSystem->depositMoney($accountNumber, $amount);
    }

    if ($action == "withdraw") {
        $accountNumber = $_POST["selectedAccount"];
        $amount = (float)$_POST["amount"];

        $message = $bankSystem->withdrawMoney($accountNumber, $amount);
    }

    if (
        strpos($message, "thất bại") !== false ||
        strpos($message, "không") !== false ||
        strpos($message, "tồn tại") !== false ||
        strpos($message, "Vui lòng") !== false
    ) {
        $alertClass = "alert-danger";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài 06 - BankAccount</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Bài 06: Quản lý tài khoản ngân hàng</h4>

            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#bankModal">
                Nhập
            </button>
        </div>

        <div class="card-body">

            <?php if ($message != "") { ?>
                <div class="alert <?php echo $alertClass; ?>">
                    <?php echo $message; ?>
                </div>
            <?php } ?>

            <h5 class="mb-3">Danh sách tài khoản</h5>

            <table class="table table-bordered table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>STT</th>
                        <th>Số tài khoản</th>
                        <th>Tên chủ tài khoản</th>
                        <th>Số dư</th>
                    </tr>
                </thead>

                <tbody>
                    <?php echo $bankSystem->displayAccounts(); ?>
                </tbody>
            </table>

        </div>
    </div>

</div>

<div class="modal fade" id="bankModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="post" class="modal-content">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Thao tác tài khoản</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <label class="form-label">Chọn thao tác</label>
                    <select name="action" id="action" class="form-select" onchange="changeBankAction()">
                        <option value="create">Tạo tài khoản mới</option>
                        <option value="deposit">Nạp tiền</option>
                        <option value="withdraw">Rút tiền</option>
                    </select>
                </div>

                <div id="createBox">
                    <div class="mb-3">
                        <label class="form-label">Số tài khoản</label>
                        <input type="text" name="accountNumber" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tên chủ tài khoản</label>
                        <input type="text" name="ownerName" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Số dư ban đầu</label>
                        <input type="number" name="balance" class="form-control" min="0" value="0">
                    </div>
                </div>

                <div id="moneyBox" style="display:none;">
                    <div class="mb-3">
                        <label class="form-label">Chọn tài khoản</label>
                        <select name="selectedAccount" class="form-select">
                            <?php foreach ($_SESSION["accounts"] as $account) { ?>
                                <option value="<?php echo htmlspecialchars($account["accountNumber"]); ?>">
                                    <?php echo htmlspecialchars($account["accountNumber"] . " - " . $account["ownerName"]); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Số tiền</label>
                        <input type="number" name="amount" class="form-control" min="0" value="0">
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="submit" class="btn btn-primary">Xác nhận</button>
            </div>

        </form>
    </div>
</div>

<script>
    function changeBankAction() {
        let action = document.getElementById("action").value;

        if (action === "create") {
            document.getElementById("createBox").style.display = "block";
            document.getElementById("moneyBox").style.display = "none";
        } else {
            document.getElementById("createBox").style.display = "none";
            document.getElementById("moneyBox").style.display = "block";
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>