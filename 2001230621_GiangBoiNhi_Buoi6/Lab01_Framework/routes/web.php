<?php

// Import lớp Route để khai báo Route
use Illuminate\Support\Facades\Route;

// Import Controller
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| File này dùng để khai báo các Route của ứng dụng Laravel.
|--------------------------------------------------------------------------
*/


// ======================================================
// BÀI 2.1
// URL: http://localhost:8000/hello
// ======================================================

Route::get('/hello', function () {

    return 'Xin chào Laravel 12!';

});

/*
Giải thích

Route::get()
- Tạo Route sử dụng phương thức GET.

'/hello'
- URL người dùng truy cập.

function()
- Hàm xử lý Route.

return
- Trả về chuỗi văn bản cho trình duyệt.
*/


// ======================================================
// BÀI 2.2
// URL: http://localhost:8000/time
// ======================================================

Route::get('/time', function () {

    return now()->format('H:i:s d/m/Y');

});

/*
Giải thích

now()
- Lấy thời gian hiện tại.

format()
- Định dạng ngày giờ.

H : Giờ

i : Phút

s : Giây

d : Ngày

m : Tháng

Y : Năm
*/


// ======================================================
// BÀI 2.3
// URL: /sum/{a}/{b}
// Ví dụ: /sum/5/8
// ======================================================

Route::get('/sum/{a}/{b}', function ($a, $b) {

    if (!is_numeric($a) || !is_numeric($b)) {
        return response('Tham số phải là số nguyên', 400);
    }

    return (int)$a + (int)$b;

});

/*
Giải thích

Route::get()
- Tạo Route GET.

'/sum/{a}/{b}'
- Nhận 2 tham số từ URL.

function($a,$b)
- Nhận giá trị a và b.

is_numeric()
- Kiểm tra dữ liệu có phải là số.

response()
- Trả về Response.

400
- Bad Request.

(int)
- Ép kiểu sang số nguyên.

Ví dụ

/sum/5/8
=> 13

/sum/a/8
=> Tham số phải là số nguyên
*/


// ======================================================
// BÀI 3
// URL: /students
// ======================================================

Route::get('/students', [StudentController::class, 'index']);

/*
Giải thích

StudentController::class
- Gọi Controller StudentController.

index
- Thực hiện phương thức index().

Chức năng

Hiển thị danh sách sinh viên từ mảng tĩnh.
*/


// ======================================================
// BÀI 4
// URL: /students/db
// ======================================================

Route::get('/students/db', [StudentController::class, 'indexDb']);

/*
Giải thích

indexDb()

Lấy dữ liệu từ Database
bằng Eloquent ORM.

Hiển thị danh sách sinh viên.
*/


// ======================================================
// BÀI 5
// URL: /students/combined
// ======================================================

Route::get('/students/combined', [StudentController::class, 'combined']);

/*
Giải thích

combined()

So sánh hai nguồn dữ liệu:

- Mảng tĩnh

- Database

Người dùng chọn thông qua
tham số source.
*/


// ======================================================
// BÀI 7
// URL: /about
// ======================================================

Route::get('/about', [PageController::class, 'about']);

/*
Giải thích

PageController

Gọi phương thức about()

Hiển thị trang giới thiệu.
*/


// ======================================================
// BÀI 8
// URL: /students/create
// ======================================================

Route::get('/students/create', [StudentController::class, 'create']);

/*
Giải thích

create()

Hiển thị Form thêm sinh viên.
*/


// ======================================================
// BÀI 8
// URL: /students
// ======================================================

Route::post('/students', [StudentController::class, 'store']);

/*
Giải thích

Route::post()

Nhận dữ liệu từ Form.

store()

Validate dữ liệu.

Lưu dữ liệu vào Database.

Sau đó chuyển về
danh sách sinh viên.
*/