<?php
// Tạo class Car
class Car {
    // Thuộc tính public có thể truy cập trực tiếp bên ngoài class
    public $brand;
    public $color;

    // Phương thức hiển thị thông tin xe
    public function showInfo() {
        echo "Brand: {$this->brand}, Color: {$this->color}<br>";
    }
}

// Tạo đối tượng thứ nhất
$car1 = new Car();
$car1->brand = "Toyota";
$car1->color = "Red";
$car1->showInfo();

// Tạo đối tượng thứ hai
$car2 = new Car();
$car2->brand = "Honda";
$car2->color = "Blue";
$car2->showInfo();
?>