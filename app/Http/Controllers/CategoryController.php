<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = Post::where('category_id', $category->id)->get();
        $listcategory = Category::get();
        // dd($posts);
        $title = $category->name;
        return view('layouts.category', compact('category', 'posts', 'title', 'listcategory'));
    }
}
