<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;

beforeEach(function () {
    RateLimiter::clear('admin@example.com|127.0.0.1');
});

test('tamu yang mengakses /admin dialihkan ke halaman /login', function () {
    $response = $this->get('/admin');

    $response->assertRedirect('/login');
});

test('admin dapat login dengan email dan password yang benar', function () {
    $user = User::factory()->create([
        'email' => 'admin@example.com',
        'password' => Hash::make('secret123'),
    ]);

    $response = $this->post('/login', [
        'email' => 'admin@example.com',
        'password' => 'secret123',
    ]);

    $response->assertRedirect('/admin');
    $this->assertAuthenticatedAs($user);
});

test('login gagal jika password salah dan menampilkan pesan error', function () {
    User::factory()->create([
        'email' => 'admin@example.com',
        'password' => Hash::make('secret123'),
    ]);

    $response = $this->from('/login')->post('/login', [
        'email' => 'admin@example.com',
        'password' => 'passwordsalah',
    ]);

    $response->assertRedirect('/login');
    $response->assertSessionHasErrors('email');
    $this->assertGuest();
});

test('admin dapat melakukan logout dan sesi dibatalkan', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/logout');

    $response->assertRedirect('/');
    $this->assertGuest();
});

test('percobaan login gagal 5 kali berturut-turut memicu rate limiter', function () {
    User::factory()->create([
        'email' => 'admin@example.com',
        'password' => Hash::make('secret123'),
    ]);

    for ($i = 0; $i < 5; $i++) {
        $this->post('/login', [
            'email' => 'admin@example.com',
            'password' => 'salah',
        ]);
    }

    $response = $this->post('/login', [
        'email' => 'admin@example.com',
        'password' => 'secret123',
    ]);

    $response->assertSessionHasErrors('email');
    $this->assertStringContainsString('Terlalu banyak percobaan login', session('errors')->first('email'));
});

