<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
        return view('articles.create', [
            'categories' => Category::orderBy('name', 'ASC')->get()
        ]);
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
            'category_id' => $request->category_id,
            'title' => $request->title,
            'caption' => $request->caption,
            'body' => $request->body,
            'status' => $request->status
        ]);

        return redirect('articles')->with('message', 'Article created!');

    }

    // Show a single public article
    public function show(Article $article){

        $article->views = $article->views + 1;
        $article->save();

        return view('articles.show', [
            'article' => Article::where('id', $article->id)->where('status', 'public')->first()
        ]);
    }

    // Show edit article form
    public function edit(Article $article){
        return view('articles.edit', [
            'article' => $article,
            'categories' => Category::orderBy('name', 'ASC')->get()
        ]);
    }

    // Update article
    public function update(Request $request, Article $article){

        $request->validate([
            'title' => 'required',
            'status' => 'required'
        ]);

        $article->title = $request->title;
        $article->caption = $request->caption;
        $article->body = $request->body;
        $article->status = $request->status;

        $article->save();

        return redirect('dashboard')->with('message', 'Article updated!');
    }

    // Show edit article image form
    public function editImage(Article $article){
        return view('articles.image-select', [
            'article' => $article
        ]);
    }

    // Upload image
    public function uploadImage(Article $article, Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,webp,svg|max:2048|dimensions:min_width=100,min_height=100'
        ]);

        if($request->hasFile('image')){
            $article->saveImage($request);
        }
        
        return redirect('articles/'.$article->hex.'/image/crop')->with('message', 'Your image was uploaded. Now let\'s crop it.');
    }

    // Crop Image
    public function cropImage(Article $article){
        return view('articles.image-crop', [
            'article' => $article
        ]);
    }

    // Render image
    public function renderImage(Article $article, Request $request){
        $data = $request->validate([
            'x' => 'required',
            'y' => 'required',
            'w' => 'required',
            'h' => 'required'
        ]);

        $article->saveRenderedImage($data);

        return redirect('dashboard')->with('message', 'Your image has been cropped.');
    }

    // Show confirm delete form
    public function showConfirmDeleteForm(Article $article){
        return view('articles.confirm-delete', [
            'article' => $article
        ]);
    }

    // Destroy
    public function destroy(Request $request){
        $article = Article::where('hex', $request->hex)->first();
        $article->delete();
        File::deleteDirectory(public_path('images/articles/'.$request->hex));

        return redirect('dashboard')->with('success', 'The article was permanently deleted.');
    }
}
