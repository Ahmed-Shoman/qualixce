<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        // Return only active articles for the frontend
        $articles = Article::where('is_active', true)->latest()->get();

        return ArticleResource::collection($articles);
    }

    public function show(Article $article)
    {
        // Allow showing inactive only if needed (for preview maybe)
        if (!$article->is_active) {
            return response()->json(['message' => 'Article not active'], 403);
        }

        return new ArticleResource($article);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|array',
            'subtitle' => 'nullable|array',
            'content' => 'nullable|array',
            'image_alt' => 'nullable|array',
            'image' => 'nullable|file|image|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        $article = Article::create($data);

        return new ArticleResource($article);
    }

    public function update(Request $request, Article $article)
    {
        $data = $request->validate([
            'title' => 'sometimes|required|array',
            'subtitle' => 'nullable|array',
            'content' => 'nullable|array',
            'image_alt' => 'nullable|array',
            'image' => 'nullable|file|image|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        $article->update($data);

        return new ArticleResource($article);
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return response()->json(['message' => 'Article deleted successfully']);
    }
}