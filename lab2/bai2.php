<?php
// Tạo class Student
class Student {
    // Thuộc tính private chỉ dùng được bên trong class
    private $name;
    private $age;

    // Constructor tự chạy khi tạo đối tượng
    public function __construct($name, $age) {
        $this->name = $name;
        $this->age = $age;
    }

    // Phương thức hiển thị thông tin sinh viên
    public function display() {
        echo "Name: {$this->name}, Age: {$this->age}<br>";
    }

    // Destructor tự chạy khi đối tượng kết thúc
    public function __destruct() {
        echo "Đối tượng Student đã bị hủy.<br>";
    }
}

// Tạo đối tượng
$student1 = new Student("Nguyen Van A", 20);

// Gọi phương thức hiển thị
$student1->display();
?>