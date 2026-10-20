<?php

use App\Models\ContactMessage;
use App\Models\User;

test('admin dapat melihat daftar pesan masuk di admin inbox', function () {
    $admin = User::factory()->create();

    $message = ContactMessage::create([
        'name' => 'I Made Suardana',
        'email' => 'made@example.com',
        'phone' => '081234567890',
        'subject' => 'Tanya Biaya Pembuatan Web',
        'message' => 'Halo, kami ingin menanyakan penawaran harga pembuatan website profil perusahaan.',
        'status' => 'unread',
    ]);

    $response = $this->actingAs($admin)->get('/admin/pesan');

    $response->assertStatus(200);
    $response->assertSee('I Made Suardana');
    $response->assertSee('Tanya Biaya Pembuatan Web');
});

test('admin dapat membuka halaman detail pesan', function () {
    $admin = User::factory()->create();

    $message = ContactMessage::create([
        'name' => 'Ni Wayan Sari',
        'email' => 'sari@example.com',
        'phone' => '081987654321',
        'subject' => 'Konsultasi Aplikasi Kasir',
        'message' => 'Apakah bisa membuat sistem POS untuk restoran di daerah Ubud?',
        'status' => 'unread',
    ]);

    $response = $this->actingAs($admin)->get("/admin/pesan/{$message->id}");

    $response->assertStatus(200);
    $response->assertSee('Ni Wayan Sari');
    $response->assertSee('sari@example.com');
    $response->assertSee('Apakah bisa membuat sistem POS untuk restoran di daerah Ubud?');
});

test('admin dapat menandai pesan sebagai sudah dibaca dan handled_by otomatis terisi', function () {
    $admin = User::factory()->create();

    $message = ContactMessage::create([
        'name' => 'Gede Ari',
        'email' => 'gede@example.com',
        'phone' => '081122334455',
        'subject' => 'Kerjasama Proyek Desain',
        'message' => 'Kami mengundang tim CSM untuk ikut dalam tender proyek desain aplikasi.',
        'status' => 'unread',
    ]);

    $response = $this->actingAs($admin)->patch("/admin/pesan/{$message->id}/read");

    $response->assertRedirect();
    $this->assertDatabaseHas('contact_messages', [
        'id' => $message->id,
        'status' => 'read',
        'handled_by' => $admin->id,
    ]);
});

test('admin dapat menyimpan catatan internal admin pada pesan', function () {
    $admin = User::factory()->create();

    $message = ContactMessage::create([
        'name' => 'Ketut Dharma',
        'email' => 'ketut@example.com',
        'phone' => '087788990011',
        'subject' => 'Permintaan Proposal',
        'message' => 'Mohon kirimkan proposal layanan ke email kantor kami.',
        'status' => 'unread',
    ]);

    $response = $this->actingAs($admin)->patch("/admin/pesan/{$message->id}/note", [
        'admin_note' => 'Sudah dihubungi via WhatsApp dan proposal terkirim tanggal 19.',
    ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('contact_messages', [
        'id' => $message->id,
        'admin_note' => 'Sudah dihubungi via WhatsApp dan proposal terkirim tanggal 19.',
        'handled_by' => $admin->id,
    ]);
});

test('admin dapat menghapus pesan', function () {
    $admin = User::factory()->create();

    $message = ContactMessage::create([
        'name' => 'Spam Sender',
        'email' => 'spam@example.com',
        'phone' => '08000000000',
        'subject' => 'Spam Message',
        'message' => 'Pesan spam promosi yang tidak relevan.',
        'status' => 'unread',
    ]);

    $response = $this->actingAs($admin)->delete("/admin/pesan/{$message->id}");

    $response->assertRedirect('/admin/pesan');
    $this->assertDatabaseMissing('contact_messages', [
        'id' => $message->id,
    ]);
});

