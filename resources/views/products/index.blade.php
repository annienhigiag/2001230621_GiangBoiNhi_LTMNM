@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Danh sách sản phẩm</h2>
    
    <a href="{{ route('products.create') }}" class="btn btn-success mb-3">Thêm sản phẩm mới</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Tên</th>
            <th>Giá</th>
            <th>Tồn kho</th>
            <th>Danh mục</th>
            <th>Hành động</th>
        </tr>
        @foreach($products as $p)
        <tr>
            <td>{{ $p->name }}</td>
            <td>{{ number_format($p->price) }} đ</td>
            <td>{{ $p->stock }}</td>
            <td>{{ $p->category->name ?? 'Chưa phân loại' }}</td>
            <td>
                <a href="{{ route('products.edit', $p->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                <form action="{{ route('products.destroy', $p->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {{ $products->links() }}
</div>
@endsection