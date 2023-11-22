<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct()
    {
       $this->meta = [
            'title' => 'POP'
       ];
    }

    // Show dashboard index page
    public function index(){
        $buttons = [
            [
                'link' => '/dashboard/articles',
                'label' => 'News',
                'icon' => 'newspaper',
                'color' => 'blue',
                'required_user_type' => 2
            ],
            [
                'link' => '/dashboard/categories',
                'label' => 'Categories',
                'icon' => 'folder',
                'color' => 'pink',
                'required_user_type' => 2
            ],
            [
                'link' => '/profile',
                'label' => 'Profile',
                'icon' => 'user',
                'color' => 'purple',
                'required_user_type' => 1
            ],
            [
                'link' => '/dashboard/sandbox',
                'label' => 'Sandbox',
                'icon' => 'image',
                'color' => 'red',
                'required_user_type' => 4
            ],
        ];
        return view('dashboard.index', [
            'buttons' => $buttons
        ]);
    }

    // Show articles index
    public function articlesIndex(){
        if(verifyPermissions() === false){
                return redirect('dashboard')->with('message', 'You don\'t have permission to view that page.');
        }
        return view('dashboard.articles-index', [
            'articles' => Article::orderBy('created_at', 'DESC')->latest()->paginate(12)
        ]);
    }

    // Show categories index
    public function categoriesIndex(){
        if(verifyPermissions() === false){
            return redirect('dashboard')->with('message', 'You don\'t have permission to view that page.');
        }
        return view('dashboard.categories-index', [
            'categories' => Category::orderBy('created_at', 'DESC')->latest()->paginate(12)
        ]);
    }

     // Show sandbox
     public function showSandbox(){
        if(verifyPermissions() === false){
            return redirect('dashboard')->with('message', 'You don\'t have permission to view that page.');
        }
        return view('dashboard.sandbox');
    }

     // Show sandbox elements
     public function showSandboxElements($elements = null){
        if(verifyPermissions() === false){
            return redirect('dashboard')->with('message', 'You don\'t have permission to view that page.');
        }
        return view('dashboard.sandbox-'.$elements);
    }
}
