{{-- Chỉ định file view này kế thừa cấu trúc khung giao diện từ layouts/app.blade.php --}}
@extends('layouts.app')

{{-- Đưa tiêu đề "Danh sách bài viết" vào vùng @yield('title') ở layout chính --}}
@section('title', 'Danh sách bài viết')

{{-- Bắt đầu định nghĩa khối nội dung chính để chèn vào vùng @yield('content') ở layout chính --}}
@section('content')
<!-- Khung div sử dụng Flexbox để căn chỉnh tiêu đề H2 và Nút Xuất File CSV nằm cùng hàng -->
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
    <!-- Tiêu đề trang H2 -->
    <h2>Danh sách bài viết</h2>
    
    <!-- Thẻ liên kết dạng nút bấm kích hoạt tính năng xuất dữ liệu ra file CSV (Excel) -->
    <a href="{{ route('articles.export.csv') }}" style="background: #059669; color: white; padding: 8px 16px; text-decoration: none; border-radius: 6px; font-weight: bold;">
        📥 Xuất File CSV (Excel)
    </a>
</div>

<!-- Bắt đầu bảng hiển thị danh sách bài viết -->
<table>
    <!-- Thẻ chứa hàng tiêu đề các cột -->
    <thead>
        <!-- Dòng chứa các ô tiêu đề cột -->
        <tr>
            <th>ID</th> <!-- Tiêu đề cột ID bài viết -->
            <th>Tiêu đề</th> <!-- Tiêu đề cột Tiêu đề bài viết -->
            <th>Hành động</th> <!-- Tiêu đề cột các nút thao tác (Xem, Sửa, Xoá) -->
        </tr>
    </thead>
    
    <!-- Thân bảng chứa dữ liệu được lặp từ mảng $articles -->
    <tbody>
        {{-- Cấu trúc vòng lặp @forelse: duyệt mảng $articles, gán dữ liệu từng bài viết vào biến $a --}}
        @forelse($articles as $a)
            <!-- Mở dòng hiển thị dữ liệu cho từng bài viết -->
            <tr>
                <!-- Ô hiển thị giá trị ID của bài viết -->
                <td>{{ $a['id'] }}</td>
                
                <!-- Ô hiển thị Tiêu đề của bài viết -->
                <td>{{ $a['title'] }}</td>
                
                <!-- Ô chứa các liên kết và form thao tác -->
                <td>
                    <!-- Link dẫn đến trang chi tiết bài viết theo ID bằng named route articles.show -->
                    <a href="{{ route('articles.show', $a['id']) }}">Xem</a> |
                    
                    <!-- Link dẫn đến trang chỉnh sửa bài viết theo ID bằng named route articles.edit -->
                    <a href="{{ route('articles.edit', $a['id']) }}">Sửa</a> |
                    
                    <!-- Form gửi yêu cầu xoá an toàn chuẩn RESTful -->
                    <form action="{{ route('articles.destroy', $a['id']) }}" method="POST" style="display: inline">
                        {{-- Directive tạo token ẩn bảo mật bắt buộc để phòng chống tấn công giả mạo CSRF --}}
                        @csrf
                        
                        {{-- Directive giả lập phương thức HTTP DELETE trong Laravel --}}
                        @method('DELETE')
                        
                        <!-- Nút kích hoạt xoá kèm sự kiện confirm JavaScript để xác nhận lại trước khi xoá -->
                        <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xoá bài viết #{{ $a['id'] }} này không?')">
                            Xoá
                        </button>
                    </form>
                </td>
            </tr>
        {{-- Nhánh thực thi khi mảng dữ liệu $articles rỗng (không có bài viết nào) --}}
        @empty
            <!-- Dòng thông báo rỗng -->
            <tr>
                <!-- Ô thông báo gộp cả 3 cột bằng thuộc tính colspan="3" -->
                <td colspan="3">Chưa có bài viết.</td>
            </tr>
        {{-- Kết thúc cấu trúc vòng lặp @forelse --}}
        @endforelse
    </tbody>
</table>

{{-- Đẩy mã JavaScript bên trong vào vị trí @stack('scripts') trên layout chính --}}
@push('scripts')
<!-- Thẻ mở khối Script JavaScript -->
<script>
    // Ghi dòng thông báo ra Tab Console của Trình duyệt để kiểm tra trang đã tải xong
    console.log('Articles index loaded');
</script>
<!-- Thẻ đóng khối Script JavaScript -->
@endpush

{{-- Kết thúc khối định nghĩa nội dung 'content' --}}
@endsection


{{-- <!-- Dùng route() kèm mảng tham số truyền ID bài viết -->
<a href="{{ route('articles.show', $a['id']) }}">Xem</a> |
<a href="{{ route('articles.edit', $a['id']) }}">Sửa</a> |
<form action="{{ route('articles.destroy', $a['id']) }}" method="post" style="display: inline"></form> --}}