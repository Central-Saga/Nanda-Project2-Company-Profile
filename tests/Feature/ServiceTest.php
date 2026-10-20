<?php

use App\Models\Service;
use App\Models\User;

test('admin dapat menambah layanan baru', function () {
    $admin = User::factory()->create();

    $response = $this->actingAs($admin)->post('/admin/layanan', [
        'title' => 'Pengembangan Mobile App',
        'slug' => 'pengembangan-mobile-app',
        'description' => 'Layanan pembuatan aplikasi mobile untuk Android dan iOS.',
        'is_active' => '1',
        'sort_order' => 1,
    ]);

    $response->assertRedirect('/admin/layanan');
    $this->assertDatabaseHas('services', [
        'title' => 'Pengembangan Mobile App',
        'slug' => 'pengembangan-mobile-app',
        'is_active' => 1,
    ]);
});

test('slug layanan harus unik', function () {
    $admin = User::factory()->create();

    Service::create([
        'title' => 'Layanan Lama',
        'slug' => 'layanan-sama',
        'description' => 'Deskripsi layanan lama.',
    ]);

    $response = $this->actingAs($admin)->from('/admin/layanan/create')->post('/admin/layanan', [
        'title' => 'Layanan Baru',
        'slug' => 'layanan-sama',
        'description' => 'Deskripsi layanan baru.',
    ]);

    $response->assertRedirect('/admin/layanan/create');
    $response->assertSessionHasErrors('slug');
});

test('layanan non-aktif tidak ditampilkan di landing page publik', function () {
    $activeService = Service::create([
        'title' => 'Layanan Aktif',
        'slug' => 'layanan-aktif',
        'description' => 'Deskripsi layanan aktif.',
        'is_active' => true,
    ]);

    $inactiveService = Service::create([
        'title' => 'Layanan Rahasia',
        'slug' => 'layanan-rahasia',
        'description' => 'Deskripsi layanan non-aktif.',
        'is_active' => false,
    ]);

    $response = $this->get('/');

    $response->assertOk();
    $response->assertSee('Layanan Aktif');
    $response->assertDontSee('Layanan Rahasia');
});

test('halaman detail layanan non-aktif mengembalikan status 404', function () {
    $inactiveService = Service::create([
        'title' => 'Layanan Nonaktif',
        'slug' => 'layanan-nonaktif',
        'description' => 'Deskripsi layanan nonaktif.',
        'is_active' => false,
    ]);

    $response = $this->get('/layanan/' . $inactiveService->slug);

    $response->assertNotFound();
});

