<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Khai báo lớp Migration
return new class extends Migration
{
    /**
     * Hàm chạy khi migrate
     */
    public function up(): void
    {
        // Tạo bảng students
        Schema::create('students', function (Blueprint $table) {

            // Khóa chính tự tăng
            $table->id();

            // Cột họ tên
            $table->string('name');

            // Email duy nhất
            $table->string('email')->unique();

            // Tuổi, cho phép NULL
            $table->unsignedInteger('age')->nullable();

            // Giới tính
            $table->string('gender')->nullable();

            // created_at và updated_at
            $table->timestamps();
        });
    }

    /**
     * Hàm rollback
     */
    public function down(): void
    {
        // Xóa bảng nếu rollback
        Schema::dropIfExists('students');
    }
};