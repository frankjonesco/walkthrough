<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    protected $site, $article, $category;
    
    public function __construct(){
        $this->site = new Site();
        $this->article = new Article();
        $this->category = new Category();
    }


    // List public articles
    public function index(){
        $articles = $this->site->publicArticles(true, 12);
        return view('articles.index', [
            'articles' => $articles,
        ]);
    }


    // List search results
    public function indexSearchResults(Request $request){
        $articles = $this->site->searchArticles($request->search_term, 'public', true);
        return view('articles.index', [
            'articles' => $articles,
            'h2' => 'Showing results for search term <span class="font-bold">"'.$request->search_term.'"</span>',
        ]);
    }


    // Show a single public article
    public function show(Article $article, string $slug = null){
        if($slug === null)
            return redirect('articles/'.$article->hex.'/'.$article->slug);
        $article->addView();

        

        return view('articles.show', [
            'article' => $article->fetch('public'),
        ]);
    }


    // Show form for creating an article
    public function create(){
        return view('articles.create', [
            'categories' => $this->site->allCategories()
        ]);
    }


    // Store new article in database
    public function store(Request $request, Article $article){
        $request->validate([
            'title' => 'required|min:3',
            'status' => 'required'
        ]);
        $article->create([
            'hex' => randomHex(),
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'caption' => $request->caption,
            'body' => $request->body,
            'tags' => strtolower($request->tags),
            'status' => $request->status
        ]);
        return redirect('articles')->with('message', 'Article created!');
    }


    // List articles that have this tag
    public function showArticlesWithTag(string $tag = null){
        $articles = $this->site->articlesWithTag($tag);
        return view('articles.index', [
            'articles' => $articles,
            'h2' => 'Showing articles that have the <span class="font-bold">"'.$tag.'"</span> tag.'
        ]);
    }


    // Show edit article form
    public function edit(Article $article){
        verifyPermissions($article);
        return view('articles.edit', [
            'article' => $article,
            'categories' => $this->site->allCategories()
        ]);
    }


    // Update article
    public function update(Request $request, Article $article){
        $request->validate([
            'title' => 'required',
            'status' => 'required'
        ]);
        $article->title = $request->title;
        $article->slug = Str::slug($request->title);
        $article->caption = $request->caption;
        $article->body = $request->body;
        $article->category_id = $request->category_id;
        $article->tags = strtolower($request->tags);
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
        // dd($article);
        if($request->hasFile('image')){
            $this->site->saveImage($request, $article, 'articles');
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


    // Update image meta
    public function updateImageMeta(Article $article, Request $request){
        $article->image_caption = $request->image_caption;
        $article->image_copyright = $request->image_copyright;
        $article->image_copyright_link = $request->image_copyright_link;
        $article->save();
        return back()->with('message', 'Image information updated!');
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
