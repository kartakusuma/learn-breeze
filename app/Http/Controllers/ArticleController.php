<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        return view('article.index', [
            'articles' => Article::get(),
        ]);
    }

    public function create()
    {
        return view('article.form');
    }

    public function store(Request $request)
    {
        $inputs = $request->only(['title', 'description']);

        $createArticle = Article::create($inputs);
        if ($createArticle) {
            return redirect('article');
        }

        return abort(500);
    }

    public function edit($id)
    {
        $article = Article::find($id);

        return view('article.form', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $inputs = $request->only(['title', 'description']);
        $article = Article::find($id);

        $updateArticle = $article->update($inputs);
        if ($updateArticle) {
            return redirect('article');
        }

        return abort(500);
    }

    public function destroy($id)
    {
        $article = Article::find($id);

        $deleteArticle = $article->delete();
        if ($deleteArticle) {
            return redirect('article');
        }

        return abort(500);
    }

}
