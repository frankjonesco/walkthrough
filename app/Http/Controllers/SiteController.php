<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\Article;
use Illuminate\Http\Request;

class SiteController extends Controller
{

    protected $site, $article, $category;
    
    public function __construct(){
        $this->site = new Site();
        $this->article = new Article();
    }
    
    // Show homepage
    public function index(){
        return view('home', [
            'articles' => $this->site->publicArticles(true)
        ]);
    }

    // View contact page
    public function viewContact(){
        return view('contact');
    }

    // View terms and conditions
    public function viewTerms(){
        return view('terms');
    }

    // Show privacy policy
    public function viewPrivacy(){
        return view('privacy');
    }
}
