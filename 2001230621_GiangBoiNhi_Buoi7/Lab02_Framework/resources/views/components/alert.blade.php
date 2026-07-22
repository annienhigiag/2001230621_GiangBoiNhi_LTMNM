<!-- Khai báo các thuộc tính đầu vào (props) có sẵn giá trị mặc định -->
@props(['type' => 'success', 'title' => 'Thông báo'])

<!-- Khung div thông báo đổi màu nền và màu chữ dựa trên giá trị của prop 'type' -->
<div style="padding: 10px; border-radius: 8px; margin-bottom: 10px;
            background: {{ $type === 'success' ? '#ECFDF5' : '#FEF3C7' }};
            color: {{ $type === 'success' ? '#065F46' : '#92400E' }};">
    <!-- Hiển thị tiêu đề thông báo dạng in đậm -->
    <strong>{{ $title }}:</strong> 
    <!-- Biến $slot chứa toàn bộ nội dung được truyền vào giữa cặp thẻ component -->
    {{ $slot }}
</div>