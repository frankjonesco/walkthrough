<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // List public articles
    public function index(){
        $articles = Article::orderBy('id', 'DESC')->where('status', 'public')->get();
        return view('articles.index', [
            'articles' => $articles
        ]);
    }

    // Show form for creating an article
    public function create(){
        return view('articles.create');
    }

    // Store new article in database
    public function store(Request $request, Article $article){

        $request->validate([
            'title' => 'required',
            'status' => 'required'
        ]);

        $article->create([
            'hex' => Str::random(11),
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'caption' => $request->caption,
            'body' => $request->body,
            'status' => $request->status
        ]);

        return redirect('articles')->with('message', 'Article created!');

    }

    // Show a single public article
    public function show(Article $article){
        return view('articles.show', [
            'article' => Article::where('id', $article->id)->where('status', 'public')->first()
        ]);
    }
}
