<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    // Show homepage
    public function showHome(){
        $articles = Article::where('status', 'public')->latest()->paginate(12);
        return view('home', [
            'articles' => $articles
        ]);
    }

    // Show about
    public function showAbout(){
        return view('about');
    }

    // Show posts
    public function showPosts(){
        return view('posts');
    }

    // Show contact
    public function showContact(){
        return view('contact');
    }
}
