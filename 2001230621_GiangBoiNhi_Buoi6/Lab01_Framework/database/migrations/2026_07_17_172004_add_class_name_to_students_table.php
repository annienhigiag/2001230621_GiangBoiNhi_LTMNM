<?php

// Import lớp Migration để tạo hoặc chỉnh sửa cấu trúc Database
use Illuminate\Database\Migrations\Migration;

// Import Blueprint để định nghĩa các cột trong bảng
use Illuminate\Database\Schema\Blueprint;

// Import Schema để thao tác với Database
use Illuminate\Support\Facades\Schema;

// Tạo một lớp Migration ẩn danh kế thừa từ Migration
return new class extends Migration
{
    /**
     * Hàm up()
     *
     * Hàm này sẽ được Laravel gọi khi chạy:
     * php artisan migrate
     *
     * Chức năng:
     * Thêm cột mới vào bảng students.
     */
    public function up(): void
    {
        // Chỉnh sửa cấu trúc bảng students
        Schema::table('students', function (Blueprint $table) {

            /**
             * string('class_name')
             * Tạo cột class_name có kiểu VARCHAR(255).
             */
            $table->string('class_name')

                  /**
                   * nullable()
                   * Cho phép cột này nhận giá trị NULL.
                   * Nếu không nhập dữ liệu thì cũng không báo lỗi.
                   */
                  ->nullable()

                  /**
                   * after('gender')
                   * Đặt cột class_name phía sau cột gender
                   * trong bảng Database.
                   */
                  ->after('gender');

        });
    }

    /**
     * Hàm down()
     *
     * Hàm này sẽ được Laravel gọi khi chạy:
     * php artisan migrate:rollback
     *
     * Chức năng:
     * Hoàn tác Migration bằng cách xóa cột class_name.
     */
    public function down(): void
    {
        // Chỉnh sửa bảng students
        Schema::table('students', function (Blueprint $table) {

            /**
             * dropColumn('class_name')
             * Xóa cột class_name khỏi bảng students.
             */
            $table->dropColumn('class_name');

        });
    }
};