<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\Article;
use Illuminate\Http\Request;

class SiteController extends Controller
{

    protected $site, $article;
    
    public function __construct(){
        $this->site = new Site();
        $this->article = new Article();
    }
    
    // Show homepage
    public function index(){
        return view('home', [
            'page_headings' => pageHeadings('Welcome to the '.config('app.name').' project', 'A complete guide to setting up a <span class="font-bold">CRUD application</span> in Laravel 10.'),
            'articles' => $this->site->publicArticles(true)
        ]);
    }

    // View contact page
    public function viewContact(){
        return view('contact', [
            'page_headings' => pageHeadings('Contact us', 'Got a question? Get in touch and we\'ll get right back to you.'),
        ]);
    }

    // View terms and conditions
    public function viewTerms(){
        return view('terms', [
            'page_headings' => pageHeadings('Terms & conditions', 'Please review the terms & conditions of the use of this website.'),
        ]);
    }

    // View privacy policy
    public function viewPrivacy(){
        return view('privacy', [
            'page_headings' => pageHeadings('Privacy policy', 'How we value your privacy and respect the use of you personal data.'),
        ]);
    }
}
