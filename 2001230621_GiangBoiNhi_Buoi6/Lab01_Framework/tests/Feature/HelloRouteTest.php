<?php

// Khai báo namespace
namespace Tests\Feature;

// Import lớp TestCase
use Tests\TestCase;

// Khai báo lớp kiểm thử
class HelloRouteTest extends TestCase
{
    /**
     * Kiểm tra Route /hello
     */
    public function test_hello_route_returns_success(): void
    {
        // Gửi yêu cầu GET đến Route /hello
        $response = $this->get('/hello');

        // Kiểm tra mã HTTP phải là 200
        $response->assertStatus(200);

        // Kiểm tra nội dung có chứa "Laravel 12"
        $response->assertSee('Laravel 12');
    }
}