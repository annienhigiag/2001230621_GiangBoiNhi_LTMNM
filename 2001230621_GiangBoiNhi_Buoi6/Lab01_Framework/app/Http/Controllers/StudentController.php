<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    // Hàm index() sẽ chạy khi truy cập Route /students
    public function index()
    {

        // Tạo mảng sinh viên (Mảng tĩnh)
        $students = [

            // Sinh viên thứ nhất
            [
                'name' => 'Nguyễn An',
                'age' => 19,
                'email' => 'an@huit.edu.vn'
            ],

            // Sinh viên thứ hai
            [
                'name' => 'Trần Bình',
                'age' => 18,
                'email' => 'binh@huit.edu.vn'
            ],

            // Sinh viên thứ ba
            [
                'name' => 'Lê Chi',
                'age' => 17,
                'email' => 'chi@huit.edu.vn'
            ],

            // Sinh viên thứ tư
            [
                'name' => 'Phạm Dũng',
                'age' => 20,
                'email' => 'dung@huit.edu.vn'
            ],

            // Sinh viên thứ năm
            [
                'name' => 'Đỗ Em',
                'age' => 21,
                'email' => 'em@huit.edu.vn'
            ]

        ];

        // Trả dữ liệu sang View students/index.blade.php
        // compact() tạo mảng ['students'=>$students]
        return view('students.index', compact('students'));
    }

    /**
     * Hiển thị danh sách sinh viên từ Database
     * Có chức năng lọc theo giới tính
     */
    public function indexDb()
    {
        // Lấy giá trị gender từ URL
        // Ví dụ:
        // ?gender=male
        // ?gender=female
        $gender = request('gender');

        // Khởi tạo Query Builder
        $query = Student::query()
            ->orderBy('id', 'desc');

        // Nếu có chọn giới tính
        if ($gender) {

            // Chỉ lấy đúng giới tính đó
            $query->where('gender', $gender);
        }

        // Phân trang 5 dòng
        // appends() giữ nguyên tham số gender khi chuyển trang
        $students = $query->paginate(5)
            ->appends(compact('gender'));

        // Trả dữ liệu sang View
        return view(
            'students.index_db',
            compact('students', 'gender')
        );
    }
    /**
     * Hiển thị Form thêm sinh viên
     */
    public function create()
    {
        // Trả về View create.blade.php
        return view('students.create');
    }

    /**
     * Lưu sinh viên vào Database
     */
    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([

            // Họ tên bắt buộc
            'name' => 'required|max:255',

            // Email bắt buộc
            // Đúng định dạng
            // Không được trùng
            'email' => 'required|email|unique:students,email',

            // Tuổi không bắt buộc
            'age' => 'nullable|integer|min:16',

            // Giới tính
            'gender' => 'required|in:male,female'

        ]);

        // Lưu dữ liệu
        Student::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'age'        => $request->age,
            'gender'     => $request->gender,
            'class_name' => $request->class_name
        ]);

        // Quay về danh sách
        return redirect('/students/db')

            // Flash message
            ->with('success', 'Tạo mới thành công');
    }
    public function combined()
    {
        // ===============================
        // MẢNG TĨNH
        // ===============================

        // Khai báo mảng sinh viên
        $static = [

            [
                'name' => 'Nguyễn An',
                'age' => 19,
                'email' => 'an@huit.edu.vn',
                'gender' => 'male'
            ],

            [
                'name' => 'Trần Bình',
                'age' => 18,
                'email' => 'binh@huit.edu.vn',
                'gender' => 'male'
            ],

            [
                'name' => 'Lê Chi',
                'age' => 17,
                'email' => 'chi@huit.edu.vn',
                'gender' => 'female'
            ],

        ];

        // ===============================
        // LẤY DỮ LIỆU TỪ DATABASE
        // ===============================

        $db = Student::orderBy('id', 'desc')
            ->paginate(5);

        // Đọc tham số source trên URL
        // Nếu không có thì mặc định là db
        $source = request('source', 'db');

        // Truyền dữ liệu sang View
        return view(
            'students.combined',
            compact('static', 'db', 'source')
        );
    }
}
