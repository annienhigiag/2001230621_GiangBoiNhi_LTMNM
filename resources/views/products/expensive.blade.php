@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Danh sách sản phẩm có giá lớn hơn 100.000đ</h2>
    
    <table class="table table-bordered">
        <tr>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Danh mục</th>
        </tr>
        @foreach($products as $p)
        <tr>
            <td>{{ $p->name }}</td>
            <td>{{ number_format($p->price) }} đ</td>
            <td>{{ $p->category->name ?? 'Chưa phân loại' }}</td>
        </tr>
        @endforeach
    </table>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
</div>
@endsection