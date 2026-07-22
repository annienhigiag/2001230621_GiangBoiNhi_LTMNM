<!-- Thanh điều hướng dùng chung cho toàn hệ thống -->
<nav style="padding: 12px; background: #111827; color: white">
    <!-- Sử dụng helper url() và route() để tạo link động -->
    <a href="{{ url('/') }}" style="color:#fff">Trang chủ</a>
    <a href="{{ route('articles.index') }}" style="color:#fff">Articles</a>
    <a href="{{ route('articles.create') }}" style="color:#fff">Tạo bài viết</a>
</nav>

{{-- <nav style="padding: 12px; background: #111827; color: white">
    <a href="{{ url('/') }}" style="color: #fff">Trang chủ</a>
    <!-- Dùng named route articles.index thay vì /articles -->
    <a href="{{ route('articles.index') }}" style="color: #fff">Articles</a>
    <!-- Dùng named route articles.create thay vì /articles/create -->
    <a href="{{ route('articles.create') }}" style="color: #fff">Tạo bài viết</a>
</nav> --}}