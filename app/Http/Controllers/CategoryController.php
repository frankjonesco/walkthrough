<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    // List public categories
    public function index(){
        $categories = Category::where('status', 'public')->orderBy('name', 'ASC')->get();
        return view('categories.index', [
            'categories' => $categories
        ]);
    }

    // Show create form
    public function create(){
        return view('categories.create');
    }

    // Store new category in database
    public function store(Request $request, Category $category){
        
        $formFields = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $category->create([
            'hex' => Str::random(11),
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status
        ]);

        return redirect('dashboard/categories')->with('message', 'Category created!');
    }


    // Edit category
    public function edit(Category $category){
        return view('categories.edit', [
            'category' => $category
        ]);
    }

    // Update category
    public function update(Category $category, Request $request){

        $formFields = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $category->name = $request->name;
        $category->description = $request->description;
        $category->status = $request->status;

        $category->save();

        return redirect('dashboard/categories')->with('message', 'Category updated!');
    }

    // Show edit article image form
    public function editImage(Category $category){
        return view('categories.image-select', [
            'category' => $category
        ]);
    }

    // Upload image
    public function uploadImage(Category $category, Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,webp,svg|max:2048|dimensions:min_width=100,min_height=100'
        ]);

        if($request->hasFile('image')){
            $category->saveImage($request);
        }
        
        return redirect('categories/'.$category->hex.'/image/crop')->with('message', 'Your image was uploaded. Now let\'s crop it.');
    }

    // Crop Image
    public function cropImage(Category $category){
        return view('categories.image-crop', [
            'category' => $category
        ]);
    }

    // Render image
    public function renderImage(Category $category, Request $request){
        $data = $request->validate([
            'x' => 'required',
            'y' => 'required',
            'w' => 'required',
            'h' => 'required'
        ]);

        $category->saveRenderedImage($data);

        return redirect('dashboard/categories')->with('message', 'Your image has been cropped.');
    }

    // Show confirm delete form
    public function showConfirmDeleteForm(Category $category){
        return view('categories.confirm-delete', [
            'category' => $category
        ]);
    }

    // Destroy
    public function destroy(Request $request){
        $category = Category::where('hex', $request->hex)->first();
        $category->delete();
        File::deleteDirectory(public_path('images/categories/'.$request->hex));
        return redirect('dashboard/categories')->with('success', 'The category was permanently deleted.');
    }

}
