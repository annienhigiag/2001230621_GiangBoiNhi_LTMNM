@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Chỉnh sửa sản phẩm</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Sử dụng component x-input điền sẵn dữ liệu cũ -->
        <div class="mb-3">
            <label for="name" class="form-label">Tên sản phẩm</label>
            <x-input name="name" type="text" :value="old('name', $product->name)" />
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Giá</label>
            <x-input name="price" type="number" :value="old('price', $product->price)" />
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Tồn kho</label>
            <x-input name="stock" type="number" :value="old('stock', $product->stock)" />
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Danh mục</label>
            <select name="category_id" class="form-control">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection