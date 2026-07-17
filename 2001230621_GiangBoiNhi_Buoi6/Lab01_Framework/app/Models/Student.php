<?php

// Khai báo namespace của Model
namespace App\Models;

// Import các trait cần thiết
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Khai báo Model Student kế thừa Model
class Student extends Model
{
    // Cho phép sử dụng Factory
    use HasFactory;

    // Cho phép gán dữ liệu hàng loạt (Mass Assignment)
    protected $fillable = [
        'name',
        'email',
        'age',
        'gender',
        'class_name'
    ];
}