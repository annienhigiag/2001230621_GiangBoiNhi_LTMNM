<?php
// Interface quy định class nào implements thì phải có hàm run()
interface CanRun {
    public function run();
}

// Abstract class Animal có phương thức trừu tượng makeSound()
abstract class Animal {
    abstract public function makeSound();
}

// Class Dog kế thừa Animal và triển khai CanRun
class Dog extends Animal implements CanRun {
    // Triển khai phương thức makeSound()
    public function makeSound() {
        echo "Woof! Woof!<br>";
    }

    // Triển khai phương thức run()
    public function run() {
        echo "Dog is running...<br>";
    }
}

// Class Cat kế thừa Animal
class Cat extends Animal {
    // Triển khai phương thức makeSound()
    public function makeSound() {
        echo "Meow! Meow!<br>";
    }
}

// Tạo đối tượng Dog
$dog = new Dog();
$dog->makeSound();
$dog->run();

// Tạo đối tượng Cat
$cat = new Cat();
$cat->makeSound();
?>