<!-- Khai báo các props nhận từ bên ngoài vào component -->
@props(['name', 'label' => null, 'type' => 'text', 'value' => ''])

<!-- Thẻ label: tự động viết hoa chữ cái đầu nếu không truyền prop label -->
<label style="display: block; margin: 8px 0 4px">{{ $label ?? ucfirst($name) }}</label>

<!-- Thẻ input: khôi phục giá trị cũ vừa nhập nếu dính lỗi bằng hàm old() -->
<input type="{{ $type }}" name="{{ $name }}" value="{{ old($name, $value) }}"
       style="width: 100%; padding: 8px; border: 1px solid #e5e7eb; border-radius: 6px">

<!-- Bắt và hiển thị lỗi validation của trường input tương ứng -->
@error($name)
    <div style="color: #991B1B; margin-top: 4px">{{ $message }}</div>
@enderror