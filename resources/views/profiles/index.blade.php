@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Danh sách thông tin Profile kèm User</h2>
    <table class="table table-bordered">
        <tr>
            <th>STT</th>
            <th>Họ tên User</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
        </tr>
        @foreach($profiles as $p)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $p->user->name }}</td>
            <td>{{ $p->user->email }}</td>
            <td>{{ $p->phone }}</td>
            <td>{{ $p->address }}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection