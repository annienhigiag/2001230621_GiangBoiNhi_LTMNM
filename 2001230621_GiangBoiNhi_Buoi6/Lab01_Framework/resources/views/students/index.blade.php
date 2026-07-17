{{-- Kế thừa layout chung --}}
@extends('layouts.app')

{{-- Tiêu đề trang --}}
@section('title','Danh sách sinh viên (Mảng)')

{{-- Nội dung --}}
@section('content')

<h2>Danh sách sinh viên - Nguồn: Mảng tĩnh</h2>

<table>

    <thead>

        <tr>

            <th>STT</th>

            <th>Họ tên</th>

            <th>Tuổi</th>

            <th>Email</th>

        </tr>

    </thead>

    <tbody>

        {{-- Duyệt từng sinh viên --}}
        @foreach($students as $s)

        <tr>

            {{-- STT tự tăng --}}
            <td>{{ $loop->iteration }}</td>

            {{-- Họ tên --}}
            <td>{{ $s['name'] }}</td>

            {{-- Tuổi --}}
            <td>{{ $s['age'] }}</td>

            {{-- Email --}}
            <td>{{ $s['email'] }}</td>

        </tr>

        @endforeach

    </tbody>

</table>

@endsection