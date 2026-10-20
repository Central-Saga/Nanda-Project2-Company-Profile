<?php

use App\Models\ContactMessage;
use App\Models\MediaFile;
use App\Models\SiteProfile;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('halaman tentang perusahaan publik menampilkan profil visi dan misi', function () {
    SiteProfile::truncate();
    SiteProfile::create([
        'company_name' => 'PT. Central Saga Mandala',
        'tagline' => 'Software House & Creative Agency Bali',
        'hero_title' => 'Membangun Impian Digital',
        'about_story' => 'Studio rekayasa software terdepan di Tabanan Bali.',
        'vision' => 'Menjadi pusat inovasi teknologi global dari Bali.',
        'mission' => 'Menghadirkan rekayasa perangkat lunak berstandar internasional.',
    ]);

    $response = $this->get('/tentang');
    $response->assertStatus(200);
    $response->assertSee('PT. Central Saga Mandala');
    $response->assertSee('Studio rekayasa software terdepan di Tabanan Bali.');
    $response->assertSee('Menjadi pusat inovasi teknologi global dari Bali.');
});

test('halaman kontak publik dapat diakses dengan formulir inquiry lengkap', function () {
    $response = $this->get('/kontak');
    $response->assertStatus(200);
    $response->assertSee('Mulai Diskusi Proyek Anda');
    $response->assertSee('name="company_name"', false);
    $response->assertSee('name="service_type"', false);
});

test('sitemap.xml dan robots.txt dapat diakses publik dengan header yang tepat', function () {
    $sitemap = $this->get('/sitemap.xml');
    $sitemap->assertStatus(200);
    $sitemap->assertHeader('Content-Type', 'text/xml; charset=UTF-8');
    $sitemap->assertSee('<urlset', false);

    $robots = $this->get('/robots.txt');
    $robots->assertStatus(200);
    $robots->assertHeader('Content-Type', 'text/plain; charset=UTF-8');
    $robots->assertSee('Disallow: /admin/');
});

test('admin dapat memperbarui status crm pipeline pada inquiry pesan', function () {
    $admin = User::first() ?? User::factory()->create();

    $message = ContactMessage::create([
        'name' => 'Klien Prospek Bali',
        'email' => 'prospek@example.com',
        'subject' => 'Inquiry Web ERP',
        'message' => 'Kami memerlukan sistem ERP terdistribusi.',
        'crm_status' => 'new',
        'status' => 'unread',
    ]);

    $response = $this->actingAs($admin)->patch('/admin/pesan/' . $message->id . '/status', [
        'crm_status' => 'in_discussion',
    ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('contact_messages', [
        'id' => $message->id,
        'crm_status' => 'in_discussion',
        'status' => 'read',
    ]);
});

test('admin dapat mengunggah dan menghapus media dari media library', function () {
    Storage::fake('public');
    $admin = User::first() ?? User::factory()->create();

    $file = UploadedFile::fake()->create('mockup-design.png', 500, 'image/png');

    $responseUpload = $this->actingAs($admin)->post('/admin/media', [
        'file' => $file,
    ]);

    $responseUpload->assertRedirect('/admin/media');
    $this->assertDatabaseHas('media_files', [
        'original_name' => 'mockup-design.png',
    ]);

    $media = MediaFile::where('original_name', 'mockup-design.png')->first();
    Storage::disk('public')->assertExists($media->file_path);

    $responseDelete = $this->actingAs($admin)->delete('/admin/media/' . $media->id);
    $responseDelete->assertRedirect('/admin/media');
    $this->assertDatabaseMissing('media_files', ['id' => $media->id]);
    Storage::disk('public')->assertMissing($media->file_path);
});

test('super admin dapat mengelola pengguna dan peran', function () {
    $admin = User::first() ?? User::factory()->create(['role' => 'super_admin']);

    $responseCreate = $this->actingAs($admin)->post('/admin/pengguna', [
        'name' => 'Editor Baru',
        'email' => 'editor.baru@example.com',
        'role' => 'editor',
        'password' => 'Rahasia123#',
        'password_confirmation' => 'Rahasia123#',
    ]);

    $responseCreate->assertRedirect('/admin/pengguna');
    $this->assertDatabaseHas('users', [
        'name' => 'Editor Baru',
        'email' => 'editor.baru@example.com',
        'role' => 'editor',
    ]);
});
