<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    protected $site;

    public function __construct(){
        $this->site = new Site();
    }

    // LIST CATEGORIES INDEX
    public function index(){
        return view('categories.index', [
            'page_headings' => pageHeadings('News categories', 'Browse our news aerticles by category.'),
            'categories' => $this->site->publicCategories(true)
        ]);
    }
    

    // SHOW SINGLE CATEGORIES AND LIST ARTICLES
    public function show(Category $category){
        return view('categories.show', [
            'page_headings' => pageHeadings($category->name, $category->description),
            'category' => $category,
            'articles' => $category->public_articles
        ]);
    }


    // ADMIN METHODS

    // SHOW CREATE CATEGORY FORM
    public function create(){
        return view('categories.create');
    }


    // STORE NEW CATEGORY IN DATABASE
    public function store(Request $request, Category $category){
        // Validate form fields
        $formFields = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);
        // Create category and insert to database
        $category->create([
            'hex' => Str::random(11),
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status
        ]);
        // Redirect to categories index
        return redirect('dashboard/categories')->with('message', 'Category created!');
    }


    // VIEW EDIT CATEGORY FORM
    public function edit(Category $category){
        return view('categories.edit', [
            'page_headings' => pageHeadings('Edit category', 'Update the category information and click Save.'),
            'category' => $category
        ]);
    }


    // UPDATE CATEGORY
    public function update(Category $category, Request $request){
        // Validate form fields
        $formFields = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);
        // Update user fields and sve to database
        $category->name = $request->name;
        $category->description = $request->description;
        $category->status = $request->status;
        $category->save();
        // Return to categories index with confirmation
        return redirect('dashboard/categories')->with('message', 'Category updated!');
    }


    // VIEW EDIT CATEGORY IMAGE FORM
    public function editImage(Category $category){
        return view('categories.image-select', [
            'page_headings' => pageHeadings('Edit category image', 'Browse you device for the image you want tot use.'),
            'category' => $category
        ]);
    }


    // UPLOADE CATEGORY IMAGE
    public function uploadImage(Category $category, Request $request){
        // Validate image parameters
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,webp,svg|max:2048|dimensions:min_width=100,min_height=100'
        ]);
        // Save image to category directory
        if($request->hasFile('image')){
            $category->saveImage($request);
        }
        // Forward to image cropper
        return redirect('categories/'.$category->hex.'/image/crop')->with('message', 'Your image was uploaded. Now let\'s crop it.');
    }


    // VIEW CROP IMAGE FORM
    public function cropImage(Category $category){
        return view('categories.image-crop', [
            'page_headings' => pageHeadings('Crop category image', 'Drag the pointer across the image to crop.'),
            'category' => $category
        ]);
    }


    // RENDER IMAGE
    public function renderImage(Category $category, Request $request){
        // Validate cropper dimensions/coordinates
        $data = $request->validate([
            'x' => 'required',
            'y' => 'required',
            'w' => 'required',
            'h' => 'required'
        ]);
        // Save cropped image to user directory
        $category->saveRenderedImage($data);
        // Return to categories index with confirmation
        return redirect('dashboard/categories')->with('message', 'Your image has been cropped.');
    }


    // VIEW DELETE CATEGORY FORM
    public function showConfirmDeleteForm(Category $category){
        return view('categories.confirm-delete', [
            'page_headings' => pageHeadings('Delete category', 'Are you sure you want to delete this category?'),
            'category' => $category
        ]);
    }


    // DESTROY CATEGORY
    public function destroy(Request $request){
        // Validate form field
        $data = $request->validate([
            'hex' => 'required'
        ]);
        // Delete category from database
        Category::where('hex', $request->hex)->delete();
        // Delete category image directory
        File::deleteDirectory(public_path('images/categories/'.$request->hex));
        // Return to categories index with confirmation
        return redirect('dashboard/categories')->with('message', 'The category was permanently deleted.');
    }

}
