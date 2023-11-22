<?php

namespace App\Models;

use App\Models\ImageProcess;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Site extends Model
{
    use HasFactory;

    // RETRIEVAL METHODS
    // ARTICLES

    // Get public articles
    public function publicArticles(bool $paginate = false, int $per_page = 12){
        if($paginate)
            return Article::where('status', 'public')->latest()->paginate($per_page);
        else
            return Article::where('status', 'public')->latest()->get();
    }

    // Get private articles
    public function privateArticles(bool $paginate = false, int $per_page = 12){
        if($paginate)
            return Article::where('status', 'private')->latest()->paginate($per_page);
        else
            return Article::where('status', 'private')->latest()->get();
    }

    // Get all articles
    public function allArticles(bool $paginate = false, int $per_page = 12){
        if($paginate)
            return Article::latest()->paginate($per_page);
        else
            return Article::latest()->get();
    }


    // Search articles
    public function searchArticles(string $search_term = null, string $status = 'public', bool $paginate = false, int $per_page = 12){
        if($paginate)
            $articles = Article::where('title', 'LIKE', '%'.$search_term.'%')
            ->where('status', 'public')
            ->orWhere('tags', 'LIKE', '%'.$search_term.'%')
            ->where('status', 'public')
            ->latest()
            ->paginate($per_page);
        else
            $articles = Article::where('title', 'LIKE', '%'.$search_term.'%')
            ->where('status', 'public')
            ->orWhere('tags', 'LIKE', '%'.$search_term.'%')
            ->where('status', 'public')
            ->latest()
            ->get();
        foreach($articles as $article){
            $article = $article->highlightSearchTerm($search_term, $article);
        }
        return $articles;
    }

    // Get articles with tag
    public function articlesWithTag(string $tag = null, bool $paginate = false, int $per_page = 12){
        if($paginate)
            return Article::where('tags','LIKE','%'.$tag.'%')->where('status', 'public')->latest()->paginate($per_page);
        else
            return Article::where('tags','LIKE','%'.$tag.'%')->where('status', 'public')->latest()->get();
    }


    // RETRIEVAL METHODS
    // CATEGORIES

    // Get public categories
    public function publicCategories(bool $paginate = false, int $per_page = 12){
        if($paginate)
            return Category::where('status', 'public')->orderBy('name', 'ASC')->paginate($per_page);
        else
            return Category::where('status', 'public')->orderBy('name', 'ASC')->get();
    }

    // Get private categories
    public function privateCategories(bool $paginate = false, int $per_page = 12){
        if($paginate)
            return Category::where('status', 'private')->orderBy('name', 'ASC')->paginate($per_page);
        else
            return Category::where('status', 'private')->orderBy('name', 'ASC')->get();
    }

    // Get all categories
    public function allCategories(bool $paginate = false, int $per_page = 12){
        if($paginate)
            return Category::orderBy('name', 'ASC')->paginate($per_page);
        else
            return Category::orderBy('name', 'ASC')->get();
    }







    // Save image (update)
    public function saveImage($request, $item, string $directory = null){
        $image = new ImageProcess();
        $item->image = $image->upload($request, $item, $directory, $this);
        return $item;
    }

    // Save rendered image (update)
    public function saveRenderedImage($data, string $directory = null){
        $image = new ImageProcess();
        $this->image = $image->renderCrop($data, $directory, $this, 840, 472);
        return $this;
    }





}
