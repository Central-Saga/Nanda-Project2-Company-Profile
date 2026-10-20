<?php

use App\Models\Project;
use App\Models\User;

test('daftar proyek publik hanya menampilkan proyek yang dipublikasikan', function () {
    $published = Project::create([
        'title' => 'Web E-Commerce Mewah',
        'slug' => 'web-ecommerce-mewah',
        'category' => 'Web Application',
        'description' => 'Sistem e-commerce terintegrasi payment gateway.',
        'is_published' => true,
    ]);

    $draft = Project::create([
        'title' => 'Sistem Rahasia Internal',
        'slug' => 'sistem-rahasia-internal',
        'category' => 'Enterprise ERP',
        'description' => 'Proyek internal rahasia.',
        'is_published' => false,
    ]);

    $response = $this->get('/proyek');

    $response->assertStatus(200);
    $response->assertSee('Web E-Commerce Mewah');
    $response->assertDontSee('Sistem Rahasia Internal');
});

test('halaman detail proyek publik menampilkan proyek berstatus published dan 404 jika belum publish', function () {
    $published = Project::create([
        'title' => 'Artisan Bali Luxury Booking',
        'slug' => 'artisan-bali-luxury-booking',
        'category' => 'Web Application',
        'description' => 'Aplikasi booking villa mewah di Bali.',
        'is_published' => true,
    ]);

    $draft = Project::create([
        'title' => 'Draft Project Unfinished',
        'slug' => 'draft-project-unfinished',
        'category' => 'Web Application',
        'description' => 'Belum siap rilis.',
        'is_published' => false,
    ]);

    $responseSuccess = $this->get('/proyek/artisan-bali-luxury-booking');
    $responseSuccess->assertStatus(200);
    $responseSuccess->assertSee('Artisan Bali Luxury Booking');

    $responseNotFound = $this->get('/proyek/draft-project-unfinished');
    $responseNotFound->assertStatus(404);
});

test('admin dapat membuat proyek baru', function () {
    $admin = User::first() ?? User::factory()->create();

    $response = $this->actingAs($admin)->post('/admin/proyek', [
        'title' => 'Aplikasi FinTech Tabanan',
        'category' => 'Mobile Application',
        'client' => 'PT Dana Mandiri',
        'completion_date' => 'Desember 2024',
        'description' => 'Aplikasi dompet digital dengan QRIS dan enkripsi end-to-end.',
        'tech_stack' => 'Flutter, Laravel, PostgreSQL',
        'is_published' => '1',
        'is_featured' => '1',
    ]);

    $response->assertRedirect('/admin/proyek');
    $this->assertDatabaseHas('projects', [
        'title' => 'Aplikasi FinTech Tabanan',
        'slug' => 'aplikasi-fintech-tabanan',
        'category' => 'Mobile Application',
        'is_featured' => 1,
    ]);
});

test('admin dapat memperbarui dan menghapus proyek', function () {
    $admin = User::first() ?? User::factory()->create();

    $project = Project::create([
        'title' => 'Proyek Awal',
        'slug' => 'proyek-awal',
        'category' => 'UI/UX Design',
        'description' => 'Deskripsi lama.',
        'is_published' => true,
    ]);

    $responseUpdate = $this->actingAs($admin)->put('/admin/proyek/' . $project->id, [
        'title' => 'Proyek Diperbarui',
        'category' => 'Web Application',
        'description' => 'Deskripsi yang sudah diperbarui secara profesional.',
        'is_published' => '1',
    ]);

    $responseUpdate->assertRedirect('/admin/proyek');
    $this->assertDatabaseHas('projects', [
        'id' => $project->id,
        'title' => 'Proyek Diperbarui',
    ]);

    $responseDelete = $this->actingAs($admin)->delete('/admin/proyek/' . $project->id);
    $responseDelete->assertRedirect('/admin/proyek');
    $this->assertDatabaseMissing('projects', ['id' => $project->id]);
});

