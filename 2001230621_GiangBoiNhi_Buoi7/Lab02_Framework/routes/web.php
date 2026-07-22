<?php

use Illuminate\Support\Facades\Route; // Nạp Facade Route để định nghĩa đường dẫn
use App\Http\Controllers\ArticleController; // Nạp ArticleController để xử lý các request RESTful

// Route mặc định trang chủ
Route::get('/', function () {
    return view('welcome'); // Trả về giao diện mặc định trang welcome
});

// 1. Route có tham số động {page} và ràng buộc dữ liệu phải là số bằng whereNumber()
Route::get('/articles/page/{page}', function ($page) {
    return "Trang bài viết số: " . (int)$page; // Chuyển đổi sang kiểu int và trả về chuỗi thông báo
})->whereNumber('page')->name('articles.page'); // Đặt tên route là 'articles.page'

// 2. Route với tham số tuỳ chọn {slug?} và ràng buộc regex chỉ chấp nhận chữ cái thường, số và dấu gạch ngang
Route::get('/articles/slug/{slug?}', function ($slug = 'khong-co-slug') {
    return "Slug: " . $slug; // Trả về giá trị slug (hoặc giá trị mặc định nếu không truyền)
})->where('slug', '[a-z0-9-]+'); // Ràng buộc Regex cho tham số slug

// 3. Route group với prefix 'admin' gom nhóm các đường dẫn quản trị
Route::prefix('admin')->group(function () {
    // Định nghĩa route /admin/articles
    Route::get('/articles', fn() => 'Quản trị bài viết')
        ->name('admin.articles.index'); // Đặt tên route là 'admin.articles.index'
});
// Khai báo trọn bộ 7 resource route CRUD cho module articles
Route::resource('articles', ArticleController::class);

use App\Models\Article;

// Route tự động ánh xạ tham số {article} vào Model Article
Route::get('/articles/show/{article}', [ArticleController::class, 'showModelBinding'])->name('articles.show.binding');

// Route xuất dữ liệu ra file CSV
Route::get('/articles/export-csv', [ArticleController::class, 'exportCsv'])->name('articles.export.csv');

// Khai báo Resource route cho Articles
Route::resource('articles', ArticleController::class);