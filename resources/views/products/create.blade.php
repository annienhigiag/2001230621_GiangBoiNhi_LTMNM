@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Thêm sản phẩm mới</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <!-- Sử dụng component x-input cho tên sản phẩm -->
        <div class="mb-3">
            <label for="name" class="form-label">Tên sản phẩm</label>
            <x-input name="name" type="text" :value="old('name')" />
        </div>

        <!-- Sử dụng component x-input cho giá -->
        <div class="mb-3">
            <label for="price" class="form-label">Giá</label>
            <x-input name="price" type="number" :value="old('price')" />
        </div>

        <!-- Sử dụng component x-input cho tồn kho -->
        <div class="mb-3">
            <label for="stock" class="form-label">Tồn kho</label>
            <x-input name="stock" type="number" :value="old('stock')" />
        </div>

        <!-- Chọn danh mục (Category) -->
        <div class="mb-3">
            <label for="category_id" class="form-label">Danh mục</label>
            <select name="category_id" class="form-control">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Lưu sản phẩm</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection