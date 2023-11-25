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


    // LIST ARTICLES INDEX
    public function index(){
        return view('articles.index', [
            'page_headings' => pageHeadings('News articles', 'View the latest articles on '.config('app.name').'.'),
            'articles' => $this->site->publicArticles(true)
        ]);
    }


    // LIST SEARCH RESULTS
    public function indexSearchResults(Request $request){
        // Validate form field
        $request->validate([
            'search_term' => 'required'
        ]);
        return view('articles.index', [
            'page_headings' => pageHeadings('Search results', 'Searching articles for <span class="font-bold">"'.$request->search_term.'"</span>.'),
            'articles' => $this->site->publicArticlesSearchResults($request->search_term, true),
        ]);
    }


    // SHOW A SINGLE PUBLIC ARTICLE
    public function show(Article $article){
        // Increment article views
        $article->addView();
        return view('articles.show', [
            'article' => $article->fetch('public'),
        ]);
    }


    // VIEW CREATE ARTICLE FORM
    public function create(){
        return view('articles.create', [
            'page_headings' => pageHeadings('Create a new article', 'Complete the form to create your article and click Create.'),
            'categories' => $this->site->allCategories()
        ]);
    }


    // STORE NEW ARTICLE IN DATABASE
    public function store(Request $request, Article $article){
        // Validate form fields
        $request->validate([
            'title' => 'required|min:3',
            'status' => 'required'
        ]);
        // Create article and insert to database
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
        // Return to articles index with confirmation
        return redirect('/dashboard/articles')->with('message', 'Article created!');
    }


    // LIST ARTICLES THAT HAVE A CERTAIN TAG
    public function showArticlesWithTag(string $tag = null){
        return view('articles.index', [
            'page_headings' => pageHeadings('Look up article tag', 'Showing articles that have the <span class="font-bold">"'.$tag.'"</span> tag.'),
            'articles' => $this->site->publicArticlesWithTag($tag)
        ]);
    }


    // VIEW EDIT ARTICLE FORM
    public function edit(Article $article){
        // Check if user can edit this article
        verifyPermissions($article);
        return view('articles.edit', [
            'article' => $article,
            'categories' => $this->site->allCategories()
        ]);
    }


    // UPDATE ARTICLE
    public function update(Request $request, Article $article){
        //Validate form fields
        $request->validate([
            'title' => 'required',
            'status' => 'required'
        ]);
        // Update article fields and save to database
        $article->title = $request->title;
        $article->slug = Str::slug($request->title);
        $article->caption = $request->caption;
        $article->body = $request->body;
        $article->category_id = $request->category_id;
        $article->tags = strtolower($request->tags);
        $article->status = $request->status;
        $article->save();
        // Return to articles index with confirmation
        return redirect('dashboard/articles')->with('message', 'Article updated!');
    }


    // VIEW EDIT ARTICLE IMAGE FORM
    public function editImage(Article $article){
        return view('articles.image-select', [
            'page_headings' => pageHeadings('Edit article image', 'Browse you device for the image you want tot use.'),
            'article' => $article
        ]);
    }


    // UPLOAD ARTICLE IMAGE
    public function uploadImage(Article $article, Request $request){
        // Validate image parameters
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,webp,svg|max:2048|dimensions:min_width=100,min_height=100'
        ]);
        // Save image to article directory
        if($request->hasFile('image')){
            $this->site->saveImage($request, $article, 'articles');
        }
        // Forward to image cropper
        return redirect('articles/'.$article->hex.'/image/crop')->with('message', 'Your image was uploaded. Now let\'s crop it.');
    }


    // VIEW CROP IMAGE FORM
    public function cropImage(Article $article){
        return view('articles.image-crop', [
            'page_headings' => pageHeadings('Crop article image', 'Drag the pointer across the image to crop.'),
            'article' => $article
        ]);
    }


    // RENDER IMAGE
    public function renderImage(Article $article, Request $request){
        // Validate cropper dimensions/coordinates
        $data = $request->validate([
            'x' => 'required',
            'y' => 'required',
            'w' => 'required',
            'h' => 'required'
        ]);
        // Save cropped image to user directory
        $article->saveRenderedImage($data);
        // Return to articles index with confirmation
        return redirect('dashboard')->with('message', 'Your image has been cropped.');
    }


    // UDATE IMAGE CAPTION/COPYRIGHT
    public function updateImageMeta(Article $article, Request $request){
        // Validate form fields
        $request->validate([
            'image_copyright_link' => 'url'
        ]);
        // Update article fields and save to database
        $article->image_caption = $request->image_caption;
        $article->image_copyright = $request->image_copyright;
        $article->image_copyright_link = $request->image_copyright_link;
        $article->save();
        // Return to articles index with confirmation
        return redirect('dashboard/articles')->with('message', 'Image information updated!');
    }


    // VIEW DELETE ARTICLE FORM
    public function showConfirmDeleteForm(Article $article){
        return view('articles.confirm-delete', [
            'page_headings' => pageHeadings('Delete article', 'Are you sure you want to delete this article?'),
            'article' => $article
        ]);
    }


    // DESTROY ARTICLE
    public function destroy(Request $request){
        // Validate form fields
        $request->validate([
            'hex' => 'required'
        ]);
        // Delete article from database
        Article::where('hex', $request->hex)->delete();
        // Delete category image directory
        File::deleteDirectory(public_path('images/articles/'.$request->hex));
        // Return to categories index with confirmation
        return redirect('dashboard/articles')->with('message', 'The article was permanently deleted.');
    }
}
