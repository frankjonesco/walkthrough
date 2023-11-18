<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Show dashboard index page
    public function index(){
        return view('dashboard.index');
    }

    // Show articles index
    public function articlesIndex(){
        return view('dashboard.articles-index', [
            'articles' => Article::orderBy('created_at', 'DESC')->latest()->paginate(12)
        ]);
    }

    // Show categories index
    public function categoriesIndex(){
        return view('dashboard.categories-index', [
            'categories' => Category::orderBy('created_at', 'DESC')->latest()->paginate(12)
        ]);
    }
}
