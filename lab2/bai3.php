<?php
// Class hỗ trợ toán học
class MathHelper {
    // Phương thức static tính tổng
    public static function add($a, $b) {
        return $a + $b;
    }
}

// Class AdvancedMath kế thừa MathHelper
class AdvancedMath extends MathHelper {
    // Phương thức static tính lũy thừa
    public static function pow($a, $b) {
        return $a ** $b;
    }
}

// Gọi phương thức static không cần tạo đối tượng
echo "3 + 5 = " . MathHelper::add(3, 5) . "<br>";
echo "2 ^ 3 = " . AdvancedMath::pow(2, 3) . "<br>";

// Class con vẫn dùng được phương thức add() của class cha
echo "10 + 20 = " . AdvancedMath::add(10, 20) . "<br>";
?>