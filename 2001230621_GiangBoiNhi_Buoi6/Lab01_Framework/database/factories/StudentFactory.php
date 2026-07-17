<?php

// Khai báo namespace của Factory
namespace Database\Factories;

// Import lớp Factory của Laravel
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Factory dùng để sinh dữ liệu mẫu cho bảng students.
 *
 * Factory giúp tạo dữ liệu giả (fake data) phục vụ:
 * - Seeder
 * - Kiểm thử (Testing)
 * - Phát triển ứng dụng
 */
class StudentFactory extends Factory
{
    /**
     * Hàm definition()
     *
     * Đây là hàm bắt buộc của Factory.
     * Laravel sẽ tự gọi hàm này mỗi khi cần tạo một bản ghi Student.
     *
     * @return array Mảng dữ liệu mẫu sẽ được thêm vào Database.
     */
    public function definition(): array
    {
        // Trả về một mảng chứa dữ liệu của một sinh viên
        return [

            /**
             * fake()
             * Trả về đối tượng Faker để sinh dữ liệu ngẫu nhiên.
             *
             * name()
             * Sinh họ tên ngẫu nhiên.
             *
             * Ví dụ:
             * Nguyễn Văn A
             * Trần Thị B
             */
            'name' => fake()->name(),

            /**
             * unique()
             * Đảm bảo Email không bị trùng.
             *
             * safeEmail()
             * Sinh Email hợp lệ.
             *
             * Ví dụ:
             * abc@gmail.com
             * student@yahoo.com
             */
            'email' => fake()->unique()->safeEmail(),

            /**
             * numberBetween(16,25)
             * Sinh một số nguyên ngẫu nhiên từ 16 đến 25.
             *
             * Ví dụ:
             * 18
             * 21
             * 25
             */
            'age' => fake()->numberBetween(16, 25),

            /**
             * randomElement()
             * Chọn ngẫu nhiên một phần tử trong mảng.
             *
             * Kết quả sẽ là:
             * male hoặc female
             */
            'gender' => fake()->randomElement([
                'male',
                'female'
            ]),

            /**
             * randomElement()
             * Chọn ngẫu nhiên một lớp học trong danh sách.
             *
             * Ví dụ:
             * DHKTPM17A
             * DHKTPM18B
             * DHKTPM19A
             */
            'class_name' => fake()->randomElement([
                'DHKTPM17A',
                'DHKTPM17B',
                'DHKTPM18A',
                'DHKTPM18B',
                'DHKTPM19A'
            ])

        ];
    }
}