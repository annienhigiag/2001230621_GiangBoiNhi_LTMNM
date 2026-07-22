<!-- Khung chứa thanh điều hướng Breadcrumb -->
<div style="margin-bottom: 16px; font-size: 14px; color: #4b5563;">
    <!-- Đường dẫn về Trang chủ luôn xuất hiện -->
    <a href="{{ url('/') }}" style="color: #2563eb; text-decoration: none;">Trang chủ</a>

    <!-- Nếu route hiện tại thuộc nhóm articles.* thì hiển thị thêm mục Articles -->
    @if(request()->routeIs('articles.*'))
        <span> / </span>
        <!-- Kiểm tra nếu đang ở đúng trang danh sách articles.index thì chỉ in chữ, ngược lại in link -->
        @if(request()->routeIs('articles.index'))
            <strong>Danh sách bài viết</strong>
        @else
            <a href="{{ route('articles.index') }}" style="color: #2563eb; text-decoration: none;">Articles</a>
        @endif
    @endif

    <!-- Nếu đang ở trang tạo mới bài viết -->
    @if(request()->routeIs('articles.create'))
        <span> / </span>
        <strong>Tạo bài viết</strong>
    @endif

    <!-- Nếu đang ở trang chỉnh sửa bài viết -->
    @if(request()->routeIs('articles.edit'))
        <span> / </span>
        <strong>Chỉnh sửa bài viết</strong>
    @endif
</div>