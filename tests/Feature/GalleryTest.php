<?php

use App\Models\GalleryItem;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('admin dapat mengunggah foto galeri dan tersimpan di storage', function () {
    Storage::fake('public');
    $admin = User::factory()->create();

    $file = UploadedFile::fake()->create('portofolio.jpg', 100, 'image/jpeg');

    $response = $this->actingAs($admin)->post('/admin/galeri', [
        'title' => 'Desain Aplikasi E-Commerce',
        'image' => $file,
        'sort_order' => 1,
    ]);

    $response->assertRedirect('/admin/galeri');

    $item = GalleryItem::first();
    expect($item)->not->toBeNull();
    expect($item->title)->toBe('Desain Aplikasi E-Commerce');

    Storage::disk('public')->assertExists($item->image_path);
});

test('menghapus item galeri juga menghapus berkas fisik dari storage', function () {
    Storage::fake('public');
    $admin = User::factory()->create();

    $file = UploadedFile::fake()->create('hapus.jpg', 100, 'image/jpeg');
    $path = $file->store('gallery', 'public');

    $item = GalleryItem::create([
        'title' => 'Item yang akan dihapus',
        'image_path' => $path,
        'sort_order' => 1,
    ]);

    Storage::disk('public')->assertExists($path);

    $response = $this->actingAs($admin)->delete('/admin/galeri/' . $item->id);

    $response->assertRedirect('/admin/galeri');
    $this->assertDatabaseMissing('gallery_items', ['id' => $item->id]);
    Storage::disk('public')->assertMissing($path);
});

