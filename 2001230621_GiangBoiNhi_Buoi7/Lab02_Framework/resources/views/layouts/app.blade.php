<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <!-- Đặt tiêu đề trang động bằng yield, có giá trị mặc định là 'Articles' -->
    <title>@yield('title', 'Articles')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Cấu hình CSS cơ bản cho Layout -->
    <style>
        body { font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif; }
        .container { max-width: 960px; margin: 24px auto; }
        .flash { padding: 10px; margin-bottom: 12px; background: #ECFDF5; color:#065F46; border-radius: 8px; }
        nav a { margin-right: 8px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #e5e7eb; padding: 8px; text-align: left; }
        th { background: #f3f4f6; }
    </style>

    <!-- Khai báo điểm chèn các file CSS bổ sung từ các view con -->
    @stack('styles')
</head>
<body>
    <!-- Nhúng partial thanh điều hướng navigation -->
    @include('partials.nav')

    <div class="container">
        <!-- Nhúng partial hiển thị thanh điều hướng Breadcrumb -->
        @include('partials.breadcrumb')

        <!-- Kiểm tra và hiển thị flash message thông báo thành công nếu có trong session -->
        @if(session('success'))
            <div class="flash">{{ session('success') }}</div>
        @endif

        <!-- Định vị vùng nhận nội dung chính từ các view con kế thừa -->
        @yield('content')
    </div>

    <!-- Nhúng partial chân trang footer -->
    @include('partials.footer')

    <!-- Khai báo điểm chèn các đoạn Javascript riêng biệt từ các view con -->
    @stack('scripts')
</body>
</html>