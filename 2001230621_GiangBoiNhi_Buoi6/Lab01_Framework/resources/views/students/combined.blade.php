{{-- Kế thừa giao diện chính layouts/app.blade.php --}}
@extends('layouts.app')

{{-- Đặt tiêu đề cho trang --}}
@section('title','So sánh nguồn dữ liệu')

{{-- Nội dung chính của trang --}}
@section('content')

<!-- Tiêu đề -->
<h2>So sánh nguồn dữ liệu: Mảng tĩnh vs CSDL (Eloquent)</h2>

{{-- =========================
     Thanh chuyển đổi nguồn dữ liệu
     ========================= --}}
<nav style="margin-bottom:12px">

    <!-- Chuyển sang hiển thị dữ liệu từ Mảng -->
    <a href="{{ url('/students/combined?source=array') }}">
        Tab: Tĩnh (Array)
    </a>

    |

    <!-- Chuyển sang hiển thị dữ liệu từ Database -->
    <a href="{{ url('/students/combined?source=db') }}">
        Tab: CSDL (Eloquent)
    </a>

</nav>

{{-- =====================================================
     Nếu biến $source bằng 'array'
     thì hiển thị dữ liệu từ Mảng tĩnh
     ===================================================== --}}
@if($source === 'array')

<h3>Nguồn: Mảng tĩnh</h3>

<table>

<thead>

<tr>

<!-- STT -->
<th>STT</th>

<!-- Họ tên -->
<th>Họ tên</th>

<!-- Tuổi -->
<th>Tuổi</th>

<!-- Giới tính -->
<th>Giới tính</th>

<!-- Email -->
<th>Email</th>

</tr>

</thead>

<tbody>

{{-- Duyệt từng phần tử trong mảng $static --}}
@foreach($static as $s)

<tr>

<!--
$loop->iteration
Đếm số thứ tự bắt đầu từ 1
-->
<td>{{ $loop->iteration }}</td>

<!-- Hiển thị tên -->
<td>{{ $s['name'] }}</td>

<!-- Hiển thị tuổi -->
<td>{{ $s['age'] }}</td>

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

<!-- Hiển thị Email -->
<td>{{ $s['email'] }}</td>

</tr>

@endforeach

</tbody>

</table>

{{-- =====================================================
     Nếu không phải Array
     thì hiển thị dữ liệu từ Database
     ===================================================== --}}
@else

<h3>Nguồn: CSDL (Eloquent)</h3>

<table>

<thead>

<tr>

<th>STT</th>

<th>Họ tên</th>

<th>Tuổi</th>

<th>Giới tính</th>

<th>Email</th>

</tr>

</thead>

<tbody>

{{-- Duyệt từng sinh viên lấy từ Database --}}
@foreach($db as $s)

<tr>

<td>

{{
    /*
    $loop->iteration
        STT của trang hiện tại

    currentPage()
        Trang hiện tại

    perPage()
        Số bản ghi trên một trang

    Công thức:

    STT = STT trong trang
          +
          (Trang hiện tại - 1)
          ×
          Số bản ghi mỗi trang

    Ví dụ:

    Trang 1:
    1 → 10

    Trang 2:
    11 → 20

    Trang 3:
    21 → 30
    */

    $loop->iteration + ($db->currentPage()-1) * $db->perPage()

}}

</td>

<!-- Hiển thị tên sinh viên -->
<td>{{ $s->name }}</td>

<!-- Hiển thị tuổi -->
<td>{{ $s->age }}</td>

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

<!-- Hiển thị Email -->
<td>{{ $s->email }}</td>

</tr>

@endforeach

</tbody>

</table>

<!-- Phân trang -->
<div style="margin-top:12px">

{{
    /*
    appends()

    Giữ lại tham số source=db
    khi chuyển sang trang kế tiếp.

    links()

    Sinh thanh phân trang tự động.
    */
    $db->appends(['source'=>'db'])->links()
}}

</div>

@endif

{{-- Kết thúc section content --}}
@endsection