<?php

// Namespace của Controller
namespace App\Http\Controllers;

// Import Request (để dùng khi cần)
use Illuminate\Http\Request;

// Khai báo lớp PageController
class PageController extends Controller
{
    /**
     * Hiển thị trang giới thiệu khóa học
     */
    public function about()
    {
        // Trả về View resources/views/about.blade.php
        return view('about');
    }
}