<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', [ProductController::class, 'index']);

Route::get('/students', [StudentController::class, 'index']);

Route::get('/profiles', [ProfileController::class, 'index']);

Route::get('/products/expensive', [ProductController::class, 'expensiveProducts']);

// Khai báo resource route cho quản lý sản phẩm
Route::resource('products', ProductController::class);

Route::get('/categories', [CategoryController::class, 'index']);

Route::get('/students/report', [StudentController::class, 'reportCourses']);

