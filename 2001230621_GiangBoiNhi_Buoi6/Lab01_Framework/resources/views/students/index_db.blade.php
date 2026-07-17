<h1>TEST NHI</h1>
{{-- Kế thừa giao diện chính từ layouts/app.blade.php --}}
@extends('layouts.app')

{{-- Đặt tiêu đề cho trang --}}
@section('title','Danh sách sinh viên (DB)')

{{-- Bắt đầu phần nội dung chính --}}
@section('content')

{{-- ==========================================================
     Kiểm tra có thông báo thành công hay không.
     Thông báo này được gửi từ Controller bằng:
     ->with('success', 'Tạo mới thành công')
     ========================================================== --}}
@if(session('success'))

<div
style="
padding:10px;
background:#d1fae5;
color:green;
margin-bottom:15px;">

    {{-- Hiển thị nội dung thông báo --}}
    {{ session('success') }}

</div>

@endif

<!-- Tiêu đề -->
<h2>Danh sách sinh viên - CSDL (Eloquent)</h2>

{{-- ==========================================================
     Form lọc sinh viên theo giới tính
     ========================================================== --}}
<form
    method="GET"
    action="{{ url('/students/db') }}"
    style="margin-bottom:12px">

    <label>Lọc giới tính:</label>

    <!--
        onchange="this.form.submit()"

        Khi người dùng chọn Nam/Nữ
        Form sẽ tự động gửi mà không cần nhấn nút Submit.
    -->
    <select
        name="gender"
        onchange="this.form.submit()">

        {{-- Hiển thị tất cả sinh viên --}}
        <option
            value=""
            @selected(empty($gender))>

            Tất cả

        </option>

        {{-- Chỉ hiển thị Nam --}}
        <option
            value="male"
            @selected(($gender ?? '') === 'male')>

            Nam

        </option>

        {{-- Chỉ hiển thị Nữ --}}
        <option
            value="female"
            @selected(($gender ?? '') === 'female')>

            Nữ

        </option>

    </select>

</form>

<!-- ==========================
     Bảng danh sách sinh viên
     ========================== -->
<table>

<thead>

<tr>

    <!-- Số thứ tự -->
    <th>STT</th>

    <!-- Họ tên -->
    <th>Họ tên</th>

    <!-- Tuổi -->
    <th>Tuổi</th>

    <!-- Giới tính -->
    <th>Giới tính</th>

    <!-- Lớp -->
    <th>Lớp</th>

    <!-- Email -->
    <th>Email</th>

    <!-- Badge tuổi -->
    <th>Nhãn tuổi</th>

</tr>

</thead>

<tbody>

{{-- Duyệt toàn bộ danh sách sinh viên --}}
@foreach($students as $s)

<tr>

<td>

{{
    /*
    $loop->iteration
        STT trong trang hiện tại

    currentPage()
        Trang hiện tại

    perPage()
        Số bản ghi trên mỗi trang

    Công thức giúp STT liên tục giữa các trang.

    Ví dụ:

    Trang 1:
    1 → 10

    Trang 2:
    11 → 20
    */

    $loop->iteration +
    ($students->currentPage()-1)
    *
    $students->perPage()
}}

</td>

<!-- Hiển thị họ tên -->
<td>

{{ $s->name }}

</td>

<!--
    //class()

    Nếu tuổi >=18
    Laravel sẽ tự thêm class adult.

    Nếu nhỏ hơn 18
    Không thêm class.
-->
<td @class(['adult' => ($s->age ?? 0) >= 18])>
    {{ $s->age }}
</td>

<!-- Hiển thị giới tính -->
<td>
    @if($s->gender == 'male')
        Nam
    @elseif($s->gender == 'female')
        Nữ
    @else
        {{ $s->gender }}
    @endif
</td>

<!-- Hiển thị lớp -->
<td>

{{ $s->class_name }}

</td>

<!-- Hiển thị Email -->
<td>

{{ $s->email }}

</td>

<!--
    Component Blade

    Truyền tuổi vào Component badge.

    resources/views/components/badge.blade.php
-->
<td>

<x-badge :age="$s->age"/>

</td>

</tr>

@endforeach

</tbody>

</table>

<!-- ==========================
     Thanh phân trang
     ========================== -->
<div style="margin-top:12px">

{{
    /*
    links()

    Laravel tự động sinh
    Previous
    Next
    1 2 3...

    dựa trên dữ liệu phân trang.
    */

    $students->links()

}}

</div>

{{-- Kết thúc phần nội dung --}}
@endsection