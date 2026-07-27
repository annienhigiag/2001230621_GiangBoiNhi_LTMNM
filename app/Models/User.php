<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// Khai báo các thuộc tính cho phép gán hàng loạt (Mass Assignment) sử dụng PHP Attribute
#[Fillable(['name', 'email', 'password'])]
// Khai báo các thuộc tính muốn ẩn đi khi chuyển đổi model thành mảng hoặc JSON
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    // Sử dụng các trait HasFactory (để dùng factory sinh dữ liệu mẫu) và Notifiable (để gửi thông báo)
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            // Ép kiểu trường email_verified_at về dạng datetime (ngày giờ)
            'email_verified_at' => 'datetime',
            // Tự động mã hóa (hash) mật khẩu khi lưu vào cơ sở dữ liệu
            'password' => 'hashed',
        ];
    }

    /**
     * Định nghĩa quan hệ One to One: 1 User sẽ có 1 Profile tương ứng[cite: 1].
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}