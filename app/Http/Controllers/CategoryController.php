<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        // Lấy tất cả danh mục kèm theo tổng số lượng sản phẩm thuộc danh mục đó
        $categories = Category::withCount('products')->get();

        return view('categories.index', compact('categories'));
    }
}
