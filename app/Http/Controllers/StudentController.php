<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('courses')->get();
        return view('students.index', compact('students'));
    }
    public function reportCourses()
{
    // Lấy danh sách sinh viên kèm theo tổng số môn học đã đăng ký
    $students = Student::withCount('courses')->get();

    return view('students.report', compact('students'));
}
}
