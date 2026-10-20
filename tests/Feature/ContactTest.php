<?php

use App\Models\ContactMessage;

test('pengunjung dapat mengirim pesan kontak yang valid', function () {
    $data = [
        'name' => 'Budi Santoso',
        'email' => 'budi@example.com',
        'phone' => '081234567890',
        'subject' => 'Pertanyaan Kerjasama Web',
        'message' => 'Halo tim Central Saga, kami tertarik untuk membuat aplikasi web bersama Anda.',
    ];

    $response = $this->post('/kontak', $data);

    $response->assertRedirect('/#kontak');
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('contact_messages', [
        'name' => 'Budi Santoso',
        'email' => 'budi@example.com',
        'subject' => 'Pertanyaan Kerjasama Web',
        'status' => 'unread',
    ]);
});

test('pengiriman form kontak gagal jika data wajib kosong', function () {
    $response = $this->from('/#kontak')->post('/kontak', [
        'name' => '',
        'email' => 'bukan-email',
        'subject' => '',
        'message' => 'pendek',
    ]);

    $response->assertRedirect('/#kontak');
    $response->assertSessionHasErrors(['name', 'email', 'subject', 'message']);
    $this->assertDatabaseCount('contact_messages', 0);
});

test('pengiriman form dengan honeypot terisi ditolak dan tidak disimpan ke database', function () {
    $data = [
        'name' => 'Spambot',
        'email' => 'bot@spam.com',
        'subject' => 'Penawaran Spam',
        'message' => 'Ini adalah pesan otomatis dari spammer.',
        'website' => 'http://spam.com',
    ];

    $response = $this->post('/kontak', $data);

    $response->assertRedirect('/#kontak');
    $this->assertDatabaseCount('contact_messages', 0);
});

