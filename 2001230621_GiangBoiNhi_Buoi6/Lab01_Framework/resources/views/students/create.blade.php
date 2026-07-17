{{-- Kế thừa giao diện chính từ layouts/app.blade.php --}}
@extends('layouts.app')

{{-- Đặt tiêu đề của trang --}}
@section('title', 'Thêm sinh viên')

{{-- Bắt đầu phần nội dung chính --}}
@section('content')

    <!-- Tiêu đề trang -->
    <h2>Thêm sinh viên mới</h2>

    {{-- ======================================
         Hiển thị tất cả lỗi Validate
         ====================================== --}}
    @if($errors->any())

        <!-- Hiển thị lỗi màu đỏ -->
        <div style="color:red">

            <ul>

                {{-- Duyệt qua tất cả các lỗi --}}
                @foreach($errors->all() as $error)

                    <!-- Hiển thị từng lỗi -->
                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <!--
        action="{{ url('/students') }}"
            Gửi dữ liệu đến Route POST /students

        method="POST"
            Sử dụng phương thức POST để thêm dữ liệu
    -->
    <form action="{{ url('/students') }}" method="POST">

        {{-- ===================================================
             @csrf
             Sinh CSRF Token để chống tấn công giả mạo Request.
             Nếu thiếu sẽ báo lỗi 419 Page Expired.
             =================================================== --}}
        @csrf

        <!-- =======================
             Nhập họ tên
             ======================= -->
        <p>

            Họ tên

            <br>

            <!--
                type="text"
                    Ô nhập văn bản

                name="name"
                    Tên biến gửi lên Controller

                old('name')
                    Nếu Validate lỗi thì giữ lại dữ liệu đã nhập.
            -->
            <input
                type="text"
                name="name"
                value="{{ old('name') }}">

            {{-- Nếu trường name có lỗi thì hiển thị --}}
            @error('name')

                <span style="color:red">

                    <!-- Thông báo lỗi -->
                    {{ $message }}

                </span>

            @enderror

        </p>

        <!-- =======================
             Nhập Email
             ======================= -->
        <p>

            Email

            <br>

            <!--
                type="email"
                Trình duyệt sẽ kiểm tra định dạng Email.
            -->
            <input
                type="email"
                name="email"
                value="{{ old('email') }}">

            {{-- Hiển thị lỗi của Email --}}
            @error('email')

                <span style="color:red">

                    {{ $message }}

                </span>

            @enderror

        </p>

        <!-- =======================
             Nhập tuổi
             ======================= -->
        <p>

            Tuổi

            <br>

            <!--
                type="number"
                Chỉ cho nhập số.
            -->
            <input
                type="number"
                name="age"
                value="{{ old('age') }}">

            {{-- Hiển thị lỗi tuổi --}}
            @error('age')

                <span style="color:red">

                    {{ $message }}

                </span>

            @enderror

        </p>

        <!-- =======================
             Chọn giới tính
             ======================= -->
        <p>

            Giới tính

            <br>

            <select name="gender">

                <!-- Giá trị mặc định -->
                <option value="">

                    Chọn giới tính

                </option>

                <!--
                    selected()
                    Nếu old('gender') bằng male
                    thì tự động thêm thuộc tính selected.
                -->
                <option
                    value="male"
                    @selected(old('gender') == 'male')>

                    Nam

                </option>

                <!--
                    Nếu old('gender') bằng female
                    thì chọn Nữ.
                -->
                <option
                    value="female"
                    @selected(old('gender') == 'female')>

                    Nữ

                </option>

            </select>

            {{-- Hiển thị lỗi giới tính --}}
            @error('gender')

                <span style="color:red">

                    {{ $message }}

                </span>

            @enderror

        </p>

        <!-- Nút gửi Form -->
        <button type="submit">

            Lưu sinh viên

        </button>

    </form>

{{-- Kết thúc phần content --}}
@endsection