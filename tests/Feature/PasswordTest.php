<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('tamu tidak dapat mengakses halaman ubah password admin', function () {
    $response = $this->get('/admin/password');

    $response->assertRedirect('/login');
});

test('admin dapat melihat halaman ubah password', function () {
    $admin = User::factory()->create();

    $response = $this->actingAs($admin)->get('/admin/password');

    $response->assertStatus(200);
    $response->assertSee('Ganti Password');
});

test('gagal memperbarui password jika password saat ini salah', function () {
    $admin = User::factory()->create([
        'password' => Hash::make('password_lama_123'),
    ]);

    $response = $this->actingAs($admin)->put('/admin/password', [
        'current_password' => 'password_salah_total',
        'password' => 'password_baru_456',
        'password_confirmation' => 'password_baru_456',
    ]);

    $response->assertSessionHasErrors('current_password');
    $this->assertTrue(Hash::check('password_lama_123', $admin->fresh()->password));
});

test('gagal memperbarui password jika password baru kurang dari 8 karakter', function () {
    $admin = User::factory()->create([
        'password' => Hash::make('password_lama_123'),
    ]);

    $response = $this->actingAs($admin)->put('/admin/password', [
        'current_password' => 'password_lama_123',
        'password' => 'pendek',
        'password_confirmation' => 'pendek',
    ]);

    $response->assertSessionHasErrors('password');
});

test('gagal memperbarui password jika konfirmasi password tidak cocok', function () {
    $admin = User::factory()->create([
        'password' => Hash::make('password_lama_123'),
    ]);

    $response = $this->actingAs($admin)->put('/admin/password', [
        'current_password' => 'password_lama_123',
        'password' => 'password_baru_456',
        'password_confirmation' => 'password_beda_789',
    ]);

    $response->assertSessionHasErrors('password');
});

test('admin berhasil memperbarui password dengan data yang valid', function () {
    $admin = User::factory()->create([
        'password' => Hash::make('password_lama_123'),
    ]);

    $response = $this->actingAs($admin)->put('/admin/password', [
        'current_password' => 'password_lama_123',
        'password' => 'password_baru_sukses_456',
        'password_confirmation' => 'password_baru_sukses_456',
    ]);

    $response->assertRedirect('/admin/password');
    $response->assertSessionHas('success');
    $this->assertTrue(Hash::check('password_baru_sukses_456', $admin->fresh()->password));
});
