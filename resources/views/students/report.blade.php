@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Thống kê số lượng môn học của sinh viên</h2>
    <table class="table table-bordered">
        <tr>
            <th>STT</th>
            <th>Họ tên sinh viên</th>
            <th>Email</th>
            <th>Số lượng môn học đã đăng ký</th>
        </tr>
        @foreach($students as $student)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->email }}</td>
            <td>
                <span class="badge bg-success">{{ $student->courses_count }} môn</span>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
