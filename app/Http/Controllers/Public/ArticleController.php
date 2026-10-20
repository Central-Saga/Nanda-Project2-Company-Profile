<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    /**
     * Display paginated published articles with category and search filter.
     */
    public function index(Request $request): View
    {
        $query = Article::where('status', 'published')
            ->with('author');

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        if ($request->filled('tag')) {
            $tag = $request->tag;
            $query->where('tags', 'like', "%{$tag}%");
        }

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('excerpt', 'like', "%{$q}%")
                    ->orWhere('content', 'like', "%{$q}%");
            });
        }

        $articles = $query->orderByDesc('published_at')
            ->paginate(9)
            ->withQueryString();

        $categories = Article::where('status', 'published')
            ->whereNotNull('category')
            ->select('category')
            ->distinct()
            ->pluck('category');

        $featuredArticle = Article::where('status', 'published')
            ->orderByDesc('published_at')
            ->first();

        return view('public.articles.index', compact('articles', 'categories', 'featuredArticle'));
    }

    /**
     * Display single published article.
     */
    public function show(string $slug): View
    {
        $article = Article::where('slug', $slug)
            ->where('status', 'published')
            ->with('author')
            ->firstOrFail();

        $relatedArticles = Article::where('status', 'published')
            ->where('id', '!=', $article->id)
            ->when($article->category, function ($q) use ($article) {
                $q->where('category', $article->category);
            })
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();

        if ($relatedArticles->isEmpty()) {
            $relatedArticles = Article::where('status', 'published')
                ->where('id', '!=', $article->id)
                ->orderByDesc('published_at')
                ->limit(3)
                ->get();
        }

        return view('public.articles.show', compact('article', 'relatedArticles'));
    }
}
