<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    // DASHBOARD INDEX
    public function index(){
        // Create an array of buttons
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
        // Returen index
        return view('dashboard.index', [
            'page_headings' => pageHeadings('Dashboard', 'Manage your information and the content on the site.'),
            'buttons' => $buttons
        ]);
    }

    // LIST ARTICLES INDEX
    public function articlesIndex(){
        if(verifyPermissions() === false){
                return redirect('dashboard')->with('message', 'You don\'t have permission to view that page.');
        }
        return view('dashboard.articles-index', [
            'page_headings' => pageHeadings('Manage news articles', 'View and edit the article information.'),
            'articles' => Article::orderBy('created_at', 'DESC')->latest()->paginate(12)
        ]);
    }

    // LIST CATEGORIES INDEX
    public function categoriesIndex(){
        if(verifyPermissions() === false){
            return redirect('dashboard')->with('message', 'You don\'t have permission to view that page.');
        }
        return view('dashboard.categories-index', [
            'page_headings' => pageHeadings('Manage news categories', 'View and edit the category information.'),
            'categories' => Category::orderBy('created_at', 'DESC')->latest()->paginate(12)
        ]);
    }

    // VIEW SANDBOX
    public function showSandbox($elements = 'text'){
        if(verifyPermissions() === false){
            return redirect('dashboard')->with('message', 'You don\'t have permission to view that page.');
        }
        return view('dashboard.sandbox-'.$elements, [
            'page_headings' => pageHeadings('Admin sandbox', 'Review the various styles of elements used in the application'),
        ]);
    }
}
