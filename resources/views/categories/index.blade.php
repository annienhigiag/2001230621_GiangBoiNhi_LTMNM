@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Danh sách danh mục và số lượng sản phẩm</h2>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Tên danh mục</th>
            <th>Mô tả</th>
            <th>Số lượng sản phẩm</th>
        </tr>
        @foreach($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->description }}</td>
            <td><span class="badge bg-primary">{{ $category->products_count }} sản phẩm</span></td>
        </tr>
        @endforeach
    </table>
</div>
@endsection