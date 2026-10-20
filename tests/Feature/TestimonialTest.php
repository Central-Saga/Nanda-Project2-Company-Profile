<?php

use App\Models\Testimonial;
use App\Models\User;

test('testimoni yang disetujui (approved) tampil di halaman utama', function () {
    $approved = Testimonial::create([
        'name' => 'Budi Santoso',
        'role' => 'Direktur PT Maju Jaya',
        'message' => 'Layanan pembuatan web sangat profesional dan tepat waktu.',
        'rating' => 5,
        'status' => 'approved',
    ]);

    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('Budi Santoso');
    $response->assertSee('Direktur PT Maju Jaya');
});

test('testimoni berstatus pending tidak tampil di halaman utama', function () {
    Testimonial::create([
        'name' => 'Pending Client',
        'role' => 'Manager HRD',
        'message' => 'Pesan testimoni pending yang belum disetujui admin.',
        'rating' => 4,
        'status' => 'pending',
    ]);

    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertDontSee('Pending Client');
});

test('testimoni berstatus hidden tidak tampil di halaman utama', function () {
    Testimonial::create([
        'name' => 'Hidden Client',
        'role' => 'Owner Cafe',
        'message' => 'Pesan testimoni yang sengaja disembunyikan oleh admin.',
        'rating' => 3,
        'status' => 'hidden',
    ]);

    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertDontSee('Hidden Client');
});

test('admin dapat menyetujui (approve) testimoni pending', function () {
    $admin = User::factory()->create();
    $testimonial = Testimonial::create([
        'name' => 'Klien Baru',
        'role' => 'Founder Startup',
        'message' => 'Hasil pengerjaan aplikasi mobile sangat memuaskan.',
        'rating' => 5,
        'status' => 'pending',
    ]);

    $response = $this->actingAs($admin)->patch("/admin/testimoni/{$testimonial->id}/approve");

    $response->assertRedirect();
    $this->assertDatabaseHas('testimonials', [
        'id' => $testimonial->id,
        'status' => 'approved',
    ]);
});

test('admin dapat menyembunyikan (hide) testimoni approved', function () {
    $admin = User::factory()->create();
    $testimonial = Testimonial::create([
        'name' => 'Klien Lama',
        'role' => 'CTO Global Corp',
        'message' => 'Sangat merekomendasikan tim Central Saga Mandala.',
        'rating' => 5,
        'status' => 'approved',
    ]);

    $response = $this->actingAs($admin)->patch("/admin/testimoni/{$testimonial->id}/hide");

    $response->assertRedirect();
    $this->assertDatabaseHas('testimonials', [
        'id' => $testimonial->id,
        'status' => 'hidden',
    ]);
});

test('admin dapat menambahkan testimoni baru melalui form admin', function () {
    $admin = User::factory()->create();

    $response = $this->actingAs($admin)->post('/admin/testimoni', [
        'name' => 'Wayan Sukadana',
        'role' => 'Owner Toko Buku Tabanan',
        'message' => 'Website profil perusahaan meningkatkan pesanan pelanggan lokal.',
        'rating' => 5,
        'status' => 'approved',
    ]);

    $response->assertRedirect('/admin/testimoni');
    $this->assertDatabaseHas('testimonials', [
        'name' => 'Wayan Sukadana',
        'status' => 'approved',
    ]);
});

