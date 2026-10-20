<?php

use App\Http\Controllers\Admin\ActivityLogController as AdminActivityLogController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\MediaController as AdminMediaController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\Admin\PasswordController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Public\AboutController;
use App\Http\Controllers\Public\ArticleController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\GalleryController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\ProjectController;
use App\Http\Controllers\Public\ServiceController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/layanan', [ServiceController::class, 'index'])->name('services.index');
Route::get('/layanan/{slug}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/proyek', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/proyek/{slug}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/tentang', [AboutController::class, 'index'])->name('about.index');
Route::get('/galeri', [GalleryController::class, 'index'])->name('galleries.index');
Route::get('/artikel', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact.index');
Route::post('/kontak', [ContactController::class, 'store'])->middleware('throttle:5,1')->name('contact.store');

// SEO / Dynamic routes
Route::get('/sitemap.xml', [HomeController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [HomeController::class, 'robots'])->name('robots');

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// Admin Routes (Protected by auth and noindex middleware)
Route::middleware(['auth', 'noindex'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Projects CRUD
    Route::resource('proyek', AdminProjectController::class)->parameters(['proyek' => 'project']);

    // Services CRUD
    Route::resource('layanan', AdminServiceController::class)->parameters(['layanan' => 'service']);

    // Gallery CRUD
    Route::resource('galeri', AdminGalleryController::class)->parameters(['galeri' => 'gallery'])->only(['index', 'create', 'store', 'destroy']);

    // Testimonials CRUD
    Route::patch('testimoni/{testimoni}/approve', [AdminTestimonialController::class, 'approve'])->name('testimoni.approve');
    Route::patch('testimoni/{testimoni}/hide', [AdminTestimonialController::class, 'hide'])->name('testimoni.hide');
    Route::resource('testimoni', AdminTestimonialController::class);

    // Articles CRUD
    Route::resource('artikel', AdminArticleController::class);

    // Messages / Inquiries (CRM Pipeline)
    Route::get('pesan', [AdminMessageController::class, 'index'])->name('pesan.index');
    Route::get('pesan/{pesan}', [AdminMessageController::class, 'show'])->name('pesan.show');
    Route::patch('pesan/{pesan}/read', [AdminMessageController::class, 'markAsRead'])->name('pesan.read');
    Route::patch('pesan/{pesan}/status', [AdminMessageController::class, 'updateStatus'])->name('pesan.status');
    Route::patch('pesan/{pesan}/note', [AdminMessageController::class, 'updateNote'])->name('pesan.note');
    Route::delete('pesan/{pesan}', [AdminMessageController::class, 'destroy'])->name('pesan.destroy');

    // Media Library
    Route::resource('media', AdminMediaController::class)->only(['index', 'store', 'destroy']);

    // Activity Logs
    Route::get('aktivitas', [AdminActivityLogController::class, 'index'])->name('aktivitas.index');

    // User & Roles Management
    Route::resource('pengguna', AdminUserController::class)->parameters(['pengguna' => 'user']);

    // Notifications
    Route::patch('notifikasi/{notification}/read', [DashboardController::class, 'markNotificationRead'])->name('notifications.read');
    Route::post('notifikasi/read-all', [DashboardController::class, 'markAllNotificationsRead'])->name('notifications.read-all');

    // Profile & Password
    Route::get('profil', [ProfileController::class, 'edit'])->name('profil.edit');
    Route::put('profil', [ProfileController::class, 'update'])->name('profil.update');
    Route::get('password', [PasswordController::class, 'edit'])->name('password.edit');
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
});
