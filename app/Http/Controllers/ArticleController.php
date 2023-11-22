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
        $articles = Article::orderBy('id', 'DESC')->where('status', 'public')->paginate(12);
        $meta = [
            'title' => config('app.name').' | Latest news | A jar of humour',
            'description' => 'Open news topics on whatever I want to talk about. You can read some of this shit if you like.',
            'keywords' => 'news, news articles',
        ];
        return view('articles.index', [
            'articles' => $articles,
            'meta' => $meta
        ]);
    }

    // List search results
    public function searchResults(Request $request){

        $search_term = $request->search_term;

        $articles = Article::where('title', 'LIKE', '%'.$search_term.'%')
        ->where('status', 'public')
        ->orWhere('tags', 'LIKE', '%'.$search_term.'%')
        ->where('status', 'public')
        ->latest()
        ->paginate(12);

        foreach($articles as $article){
            $case_variants = [
                $search_term,
                strtolower($search_term),
                strtoupper($search_term),
                ucfirst($search_term),
            ];

            foreach($case_variants as $case_variant){
                $highlighted_text = '<span class="bg-yellow-200 py-0.5 px-1.5 inline-block">'.$case_variant.'</span>';
                $article->title = str_replace($case_variant, $highlighted_text, $article->title);
            }

            $article->tags = str_replace(strtolower($request->search_term), '<span class="font-bold">'.strtolower($request->search_term).'</span>', $article->tags);
        }

        $meta = [
            'title' => 'Search results | '.config('app.name').' | A jar of humour',
            'description' => 'Open news topics on whatever I want to talk about. You can read some of this shit if you like.',
            'keywords' => 'news, news articles',
        ];

        return view('articles.index', [
            'articles' => $articles,
            'h2' => 'Showing results for search term <span class="font-bold">"'.$request->search_term.'"</span>',
            'meta' => $meta
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
            'slug' => Str::slug($request->title),
            'caption' => $request->caption,
            'body' => $request->body,
            'tags' => strtolower($request->tags),
            'status' => $request->status
        ]);

        return redirect('articles')->with('message', 'Article created!');

    }

    // Show a single public article
    public function show(Article $article, $slug = null){
        if($slug === null){
            return redirect('articles/'.$article->hex.'/'.$article->slug);
        }
        $article->views = $article->views + 1;
        $article->save();

        $meta = [
            'title' => $article->title.' | '.config('app.name'),
            'description' => $article->caption,
            'keywords' => $article->tags,
        ];
        return view('articles.show', [
            'article' => Article::where('id', $article->id)->where('status', 'public')->first(),
            'meta' => $meta
        ]);
    }

    // List articles that have this tag
    public function showArticlesWithTag($tag = null){
        $articles = Article::orderBy('id', 'DESC')->where('tags','LIKE','%'.$tag.'%')->where('status', 'public')->paginate(12);
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
