@extends('layouts.app')

@section('title', 'Sửa bài viết')

@section('content')
<!-- Hiển thị ID của bài viết đang thực hiện chỉnh sửa -->
<h2>Sửa bài viết #{{ $article['id'] }}</h2>

<!-- Form cập nhật dữ liệu bài viết -->
<form action="{{ route('articles.update', $article['id']) }}" method="post">
    @csrf <!-- Token bảo mật CSRF -->
    @method('PUT') <!-- Method Spoofing: giả lập phương thức HTTP PUT -->

    <!-- Gọi Component Input kèm truyền giá trị $article['title'] ban đầu -->
    <x-input name="title" label="Tiêu đề" :value="$article['title']" />

    <!-- Khung sửa nội dung có ưu tiên hiển thị lại dữ liệu cũ nếu bị lỗi validate -->
    <label style="display: block; margin: 8px 0 4px">Nội dung</label>
    <textarea name="body" rows="6" style="width: 100%; padding: 8px; border: 1px solid #e5e7eb; border-radius: 6px">{{ old('body', $article['body']) }}</textarea>
    
    <!-- Hiển thị thông báo lỗi riêng cho trường body -->
    @error('body')
        <div style="color: #991B1B; margin-top: 4px">{{ $message }}</div>
    @enderror

    <button type="submit" style="margin-top: 10px">Cập nhật</button>
</form>
@endsection

{{-- <!-- Dùng route('articles.store') và route('articles.update', $article['id']) trong thẻ form -->
<form action="{{ route('articles.store') }}" method="post"></form> --}}