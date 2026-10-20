<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Article;
use App\Services\ImageUploader;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ArticleController extends Controller
{
    /**
     * Display article listing.
     */
    public function index(Request $request): View
    {
        $query = Article::with('author');

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        if ($request->filled('status') && in_array($request->status, ['published', 'draft'])) {
            $query->where('status', $request->status);
        }

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('excerpt', 'like', "%{$q}%");
            });
        }

        $articles = $query->latest('created_at')->paginate(15)->withQueryString();
        $categories = Article::select('category')->whereNotNull('category')->distinct()->pluck('category');

        return view('admin.articles.index', compact('articles', 'categories'));
    }

    /**
     * Show form to create new article.
     */
    public function create(): View
    {
        return view('admin.articles.create');
    }

    /**
     * Store new article.
     */
    public function store(Request $request): RedirectResponse
    {
        $slug = $request->input('slug') ? Str::slug($request->input('slug')) : Str::slug($request->input('title'));
        $request->merge(['slug' => $slug]);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'slug' => ['required', 'string', 'max:220', 'unique:articles,slug'],
            'excerpt' => ['required', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'category' => ['nullable', 'string', 'max:100'],
            'tags' => ['nullable', 'string', 'max:255'],
            'reading_time' => ['nullable', 'integer', 'min:1'],
            'seo_title' => ['nullable', 'string', 'max:200'],
            'seo_description' => ['nullable', 'string', 'max:300'],
            'cover_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'status' => ['required', 'in:draft,published'],
        ]);

        $coverImagePath = null;
        if ($request->hasFile('cover_image')) {
            $coverImagePath = ImageUploader::store($request->file('cover_image'), 'articles', 1600, 82);
        }

        $publishedAt = null;
        if ($validated['status'] === 'published') {
            $publishedAt = now();
        }

        $readingTime = $validated['reading_time'] ?? null;
        if (empty($readingTime)) {
            $words = str_word_count(strip_tags($validated['content']));
            $readingTime = max(1, (int) ceil($words / 200));
        }

        $article = Article::create([
            'author_id' => auth()->id(),
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'category' => $validated['category'] ?? 'Insights',
            'tags' => $validated['tags'] ?? null,
            'reading_time' => $readingTime,
            'seo_title' => $validated['seo_title'] ?? null,
            'seo_description' => $validated['seo_description'] ?? null,
            'excerpt' => $validated['excerpt'],
            'content' => $validated['content'],
            'cover_image' => $coverImagePath,
            'status' => $validated['status'],
            'published_at' => $publishedAt,
        ]);

        ActivityLog::log('Membuat artikel baru: ' . $article->title, 'article', $article->id);

        return redirect('/admin/artikel')->with('success', 'Artikel berhasil dibuat.');
    }

    /**
     * Show form to edit article.
     */
    public function edit(Article $artikel): View
    {
        return view('admin.articles.edit', ['article' => $artikel]);
    }

    /**
     * Update article.
     */
    public function update(Request $request, Article $artikel): RedirectResponse
    {
        $slug = $request->input('slug') ? Str::slug($request->input('slug')) : Str::slug($request->input('title'));
        $request->merge(['slug' => $slug]);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'slug' => ['required', 'string', 'max:220', Rule::unique('articles', 'slug')->ignore($artikel->id)],
            'excerpt' => ['required', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'category' => ['nullable', 'string', 'max:100'],
            'tags' => ['nullable', 'string', 'max:255'],
            'reading_time' => ['nullable', 'integer', 'min:1'],
            'seo_title' => ['nullable', 'string', 'max:200'],
            'seo_description' => ['nullable', 'string', 'max:300'],
            'cover_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'status' => ['required', 'in:draft,published'],
        ]);

        $coverImagePath = $artikel->cover_image;
        if ($request->hasFile('cover_image')) {
            ImageUploader::delete($artikel->cover_image);
            $coverImagePath = ImageUploader::store($request->file('cover_image'), 'articles', 1600, 82);
        }

        $publishedAt = $artikel->published_at;
        if ($validated['status'] === 'published' && is_null($publishedAt)) {
            $publishedAt = now();
        }

        $readingTime = $validated['reading_time'] ?? $artikel->reading_time;
        if (empty($readingTime)) {
            $words = str_word_count(strip_tags($validated['content']));
            $readingTime = max(1, (int) ceil($words / 200));
        }

        $artikel->update([
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'category' => $validated['category'] ?? $artikel->category,
            'tags' => $validated['tags'] ?? $artikel->tags,
            'reading_time' => $readingTime,
            'seo_title' => $validated['seo_title'] ?? $artikel->seo_title,
            'seo_description' => $validated['seo_description'] ?? $artikel->seo_description,
            'excerpt' => $validated['excerpt'],
            'content' => $validated['content'],
            'cover_image' => $coverImagePath,
            'status' => $validated['status'],
            'published_at' => $publishedAt,
        ]);

        ActivityLog::log('Memperbarui artikel: ' . $artikel->title, 'article', $artikel->id);

        return redirect('/admin/artikel')->with('success', 'Artikel berhasil diperbarui.');
    }

    /**
     * Delete article.
     */
    public function destroy(Article $artikel): RedirectResponse
    {
        $title = $artikel->title;
        ImageUploader::delete($artikel->cover_image);
        $artikel->delete();

        ActivityLog::log('Menghapus artikel: ' . $title, 'article');

        return redirect('/admin/artikel')->with('success', 'Artikel berhasil dihapus.');
    }
}
