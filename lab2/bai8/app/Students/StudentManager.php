<?php
namespace App\Students;

class StudentManager {
    private $students;

    public function __construct(&$students) {
        $this->students = &$students;
    }

    public function addStudent($name, $age, $studentID) {
        if ($name == "" || $studentID == "") {
            return "Vui lòng nhập đầy đủ họ tên và mã sinh viên.";
        }

        if ($age <= 0) {
            return "Tuổi phải lớn hơn 0.";
        }

        foreach ($this->students as $student) {
            if ($student["studentID"] == $studentID) {
                return "Mã sinh viên đã tồn tại.";
            }
        }

        $this->students[] = [
            "name" => $name,
            "age" => $age,
            "studentID" => $studentID
        ];

        return "Thêm sinh viên thành công.";
    }

    public function displayStudents() {
        $html = "";

        foreach ($this->students as $index => $item) {
            $student = new Student(
                $item["name"],
                $item["age"],
                $item["studentID"]
            );

            $stt = $index + 1;
            $studentID = htmlspecialchars($student->getStudentID());
            $name = htmlspecialchars($student->getName());
            $age = htmlspecialchars($student->getAge());

            $html .= "
                <tr>
                    <td>$stt</td>
                    <td>$studentID</td>
                    <td>$name</td>
                    <td>$age</td>
                </tr>
            ";
        }

        return $html;
    }
}
?>