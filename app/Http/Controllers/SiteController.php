<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    // Show homepage
    public function showHome(){
        $articles = Article::where('status', 'public')->latest()->paginate(12);
        $meta = [
            'title' => config('app.name').' | Gripping news | A jar of humour',
            'description' => 'Open news topics on whatever I want to talk about. You can read some of this shit if you like.',
            'keywords' => 'news, news articles',
        ];
        return view('home', [
            'articles' => $articles,
            'meta' => $meta,
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

    // Show terms
    public function showTerms(){
        $meta = [
            'title' => 'Terms & conditions | '.config('app.name').' | Gripping news | A jar of humour',
            'description' => 'Open news topics on whatever I want to talk about. You can read some of this shit if you like.',
            'keywords' => 'news, news articles',
        ];
        return view('terms', [
            'meta' => $meta
        ]);
    }

    // Show privacy
    public function showPrivacy(){
        $meta = [
            'title' => 'Privacy policy | '.config('app.name').' | Gripping news | A jar of humour',
            'description' => 'Open news topics on whatever I want to talk about. You can read some of this shit if you like.',
            'keywords' => 'news, news articles',
        ];
        return view('privacy', [
            'meta' => $meta
        ]);
    }
}
