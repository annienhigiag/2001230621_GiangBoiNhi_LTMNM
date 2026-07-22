@extends('layouts.app')

@section('title', 'Tạo bài viết')

@section('content')
<h2>Tạo bài viết</h2>

<!-- Tái sử dụng Blade Component Alert vừa tạo với type warning -->
<x-alert type="warning" title="Lưu ý">
    Dữ liệu hiện chỉ mô phỏng (chưa lưu DB).
</x-alert>

<!-- Form gửi dữ liệu tạo bài viết qua phương thức POST -->
<form action="{{ route('articles.store') }}" method="post">
    @csrf <!-- directive liên kết sinh token bảo mật bắt buộc của Laravel -->
    
    <!-- Gọi Anonymous Component Input cho trường Tiêu đề -->
    <x-input name="title" label="Tiêu đề" />

    <!-- Khung nhập liệu nội dung dạng Textarea -->
    <label style="display: block; margin: 8px 0 4px">Nội dung</label>
    <textarea name="body" rows="6" style="width: 100%; padding: 8px; border: 1px solid #e5e7eb; border-radius: 6px">{{ old('body') }}</textarea>
    
    <!-- Kiểm tra và hiển thị lỗi validation nếu có ở trường body -->
    @error('body')
        <div style="color: #991B1B; margin-top: 4px">{{ $message }}</div>
    @enderror

    <!-- Nút Submit gửi form -->
    <button type="submit" style="margin-top: 10px">Lưu</button>
</form>
@endsection

{{-- <!-- Dùng route('articles.store') và route('articles.update', $article['id']) trong thẻ form -->
<form action="{{ route('articles.store') }}" method="post"></form> --}}