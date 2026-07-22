<!-- Nhận dạng biến thể màu sắc (variant) và kiểu nút (type) -->
@props(['variant' => 'primary', 'type' => 'submit'])

@php
    // Xác định màu nền tương ứng theo thuộc tính variant truyền vào
    $bgColor = $variant === 'danger' ? '#DC2626' : '#2563EB';
@endphp

<!-- Render nút bấm động theo định dạng đã được tính toán -->
<button type="{{ $type }}" style="background: {{ $bgColor }}; color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; margin-top: 10px;">
    {{ $slot }}
</button>