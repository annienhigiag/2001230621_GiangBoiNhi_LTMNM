@php

// ==========================
// Xử lý dữ liệu trước khi hiển thị
// ==========================

/**
 * Toán tử ??
 * Nếu biến $age tồn tại thì lấy giá trị của nó.
 * Nếu $age bị null thì lấy giá trị mặc định là 0.
 *
 * (int)
 * Ép kiểu dữ liệu sang số nguyên.
 *
 * Ví dụ:
 * $age = "20"  --> 20
 * $age = null  --> 0
 */
$age = (int)($age ?? 0);

/**
 * Kiểm tra tuổi có từ 18 trở lên hay không.
 *
 * Toán tử >=
 * So sánh lớn hơn hoặc bằng.
 *
 * Kết quả trả về:
 * true  : nếu tuổi >= 18
 * false : nếu tuổi < 18
 */
$isAdult = $age >= 18;

@endphp

<!-- Hiển thị nhãn (Badge) -->
<span

style="
/* Khoảng cách giữa nội dung và viền */
padding:2px 8px;

/* Bo tròn 4 góc */
border-radius:10px;

/* Cỡ chữ */
font-size:12px;

/**
 * Toán tử điều kiện (? :)
 *
 * Nếu $isAdult = true
 *      background màu xanh nhạt
 *
 * Ngược lại
 *      background màu đỏ nhạt
 */
background:{{ $isAdult ? '#DCFCE7' : '#FEE2E2' }};

/**
 * Nếu đủ 18 tuổi
 *      chữ màu xanh đậm
 *
 * Nếu chưa đủ 18 tuổi
 *      chữ màu đỏ đậm
 */
color:{{ $isAdult ? '#166534' : '#7F1D1D' }};
"

>

{{--
    @class()

    Nếu tuổi >=18
    Laravel sẽ tự thêm class adult.

    Nếu nhỏ hơn 18
    Không thêm class.
--}}

{{ $isAdult ? 'Adult (≥18)' : 'Under 18' }}

</span>