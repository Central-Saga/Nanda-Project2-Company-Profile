<?php

use App\Models\Article;
use App\Models\User;

test('daftar artikel publik hanya menampilkan artikel berstatus published', function () {
    $author = User::factory()->create();

    $published = Article::create([
        'author_id' => $author->id,
        'title' => 'Panduan Desain Web Modern',
        'slug' => 'panduan-desain-web-modern',
        'excerpt' => 'Ringkasan panduan desain web yang estetis dan fungsional.',
        'content' => 'Isi lengkap artikel panduan desain web modern untuk bisnis.',
        'status' => 'published',
        'published_at' => now(),
    ]);

    $draft = Article::create([
        'author_id' => $author->id,
        'title' => 'Draf Rahasia Internal',
        'slug' => 'draf-rahasia-internal',
        'excerpt' => 'Ringkasan draf artikel internal tim pengembang.',
        'content' => 'Isi draf rahasia yang belum boleh dipublikasikan.',
        'status' => 'draft',
        'published_at' => null,
    ]);

    $response = $this->get('/artikel');

    $response->assertStatus(200);
    $response->assertSee('Panduan Desain Web Modern');
    $response->assertDontSee('Draf Rahasia Internal');
});

test('halaman detail artikel publik menampilkan artikel published', function () {
    $author = User::factory()->create();

    $article = Article::create([
        'author_id' => $author->id,
        'title' => 'Transformasi Digital UMKM Bali',
        'slug' => 'transformasi-digital-umkm-bali',
        'excerpt' => 'Langkah nyata digitalisasi usaha lokal di Bali.',
        'content' => 'Konten lengkap mengenai langkah digitalisasi pelaku usaha mikro di Bali.',
        'status' => 'published',
        'published_at' => now(),
    ]);

    $response = $this->get("/artikel/{$article->slug}");

    $response->assertStatus(200);
    $response->assertSee('Transformasi Digital UMKM Bali');
    $response->assertSee($author->name);
});

test('halaman detail artikel publik menghasilkan 404 untuk artikel berstatus draft', function () {
    $author = User::factory()->create();

    $article = Article::create([
        'author_id' => $author->id,
        'title' => 'Artikel Masih Draf',
        'slug' => 'artikel-masih-draf',
        'excerpt' => 'Ringkasan draf yang belum siap tayang.',
        'content' => 'Konten lengkap artikel draf.',
        'status' => 'draft',
        'published_at' => null,
    ]);

    $response = $this->get("/artikel/{$article->slug}");

    $response->assertStatus(404);
});

test('admin dapat membuat artikel baru dan published_at otomatis terisi jika status published', function () {
    $admin = User::factory()->create();

    $response = $this->actingAs($admin)->post('/admin/artikel', [
        'title' => 'Teknologi Cloud untuk Perusahaan',
        'slug' => 'teknologi-cloud-untuk-perusahaan',
        'excerpt' => 'Penjelasan arsitektur cloud untuk keandalan infrastruktur.',
        'content' => 'Isi detail tentang manfaat implementasi arsitektur cloud computing.',
        'status' => 'published',
    ]);

    $response->assertRedirect('/admin/artikel');
    $this->assertDatabaseHas('articles', [
        'title' => 'Teknologi Cloud untuk Perusahaan',
        'status' => 'published',
        'author_id' => $admin->id,
    ]);

    $article = Article::where('slug', 'teknologi-cloud-untuk-perusahaan')->first();
    expect($article->published_at)->not->toBeNull();
});

test('admin dapat memperbarui artikel dari draft menjadi published dan published_at diset', function () {
    $admin = User::factory()->create();
    $article = Article::create([
        'author_id' => $admin->id,
        'title' => 'Artikel Awal Draf',
        'slug' => 'artikel-awal-draf',
        'excerpt' => 'Ringkasan awal.',
        'content' => 'Konten awal.',
        'status' => 'draft',
        'published_at' => null,
    ]);

    $response = $this->actingAs($admin)->put("/admin/artikel/{$article->id}", [
        'title' => 'Artikel Sudah Diterbitkan',
        'slug' => 'artikel-awal-draf',
        'excerpt' => 'Ringkasan awal yang diperbarui.',
        'content' => 'Konten awal yang diperbarui.',
        'status' => 'published',
    ]);

    $response->assertRedirect('/admin/artikel');
    $article->refresh();
    expect($article->status)->toBe('published');
    expect($article->published_at)->not->toBeNull();
});

test('admin dapat menghapus artikel', function () {
    $admin = User::factory()->create();
    $article = Article::create([
        'author_id' => $admin->id,
        'title' => 'Artikel Mau Dihapus',
        'slug' => 'artikel-mau-dihapus',
        'excerpt' => 'Ringkasan artikel yang akan dihapus.',
        'content' => 'Konten artikel.',
        'status' => 'draft',
    ]);

    $response = $this->actingAs($admin)->delete("/admin/artikel/{$article->id}");

    $response->assertRedirect('/admin/artikel');
    $this->assertDatabaseMissing('articles', [
        'id' => $article->id,
    ]);
});

