@extends('layouts.app')

@section('title','Giới thiệu')

@section('content')

<x-card title="Giới thiệu học phần">

<p>

Môn học giúp sinh viên làm quen với Laravel Framework.

</p>

</x-card>

<x-card title="Mục tiêu">

<ul>

<li>Hiểu MVC.</li>

<li>Sử dụng Blade.</li>

<li>Migration.</li>

<li>Eloquent ORM.</li>

<li>CRUD.</li>

</ul>

</x-card>

<x-card title="Lịch học">

<ol>

<li>Buổi 1</li>

<li>Buổi 2</li>

<li>Buổi 3</li>

<li>Buổi 4</li>

<li>Buổi 5</li>

<li>Buổi 6</li>

<li>Buổi 7</li>

</ol>

</x-card>

<x-card title="Chuẩn đầu ra">

<ul>

<li>Biết Laravel.</li>

<li>Thiết kế Database.</li>

<li>Thực hiện CRUD.</li>

<li>Triển khai Website.</li>

</ul>

</x-card>

@endsection