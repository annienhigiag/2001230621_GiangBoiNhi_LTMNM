<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['n'])) {

    $n = (int)$_POST['n'];
    $sum = 0;

    // Cộng từ 1 đến N
    for ($i = 1; $i <= $n; $i++) {
        $sum += $i;
    }

    echo "Tổng từ 1 đến $n là: $sum";

} else {
    echo "Vui lòng nhập N.";
}
?>