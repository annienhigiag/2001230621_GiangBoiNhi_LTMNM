<!DOCTYPE html>
<html lang="vi">

<head>

    <!-- Khai báo bảng mã UTF-8 -->
    <meta charset="UTF-8">

    <!-- Tiêu đề trang -->
    <title>@yield('title', 'Lab 01')</title>

    <!-- Responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        /* Gộp viền bảng */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        /* Định dạng ô */
        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        /* Định dạng tiêu đề bảng */
        th {
            background: #f3f4f6;
            text-align: left;
        }

        /* Chữ đậm */
        .adult {
            font-weight: 600;
        }

        /* Sửa kích thước icon phân trang */
        svg {
            width: 20px;
            height: 20px;
        }

        /* Căn giữa icon */
        svg.inline-block {
            width: 20px;
            height: 20px;
        }
    </style>

</head>

<body>

    {{-- Nhúng Header --}}
    @include('partials.header')

    <main>

        @yield('content')

    </main>

    <footer>

        <hr>

        <small>&copy; HUIT - Khoa CNTT</small>

    </footer>

</body>

</html>