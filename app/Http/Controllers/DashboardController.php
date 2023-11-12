<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Show dashboard index page
    public function index(){
        return view('dashboard.index', [
            'articles' => Article::orderBy('created_at', 'DESC')->get()
        ]);
    }
}
