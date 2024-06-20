<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $posts = Post::where('published', true)->orderBy('created_at', 'desc')->get();
        $title = 'Home';
        $carouselItems = Post::all(); // Mengambil semua item carousel dari database
        return view('layouts.index', compact('posts', 'title'));
    }


    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        // $title = $category->name;

        return view('layouts.blog-details', compact('post'));
    }

    public function details($slug)
    {

        return view('layouts.blog-details');
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = Post::where('category_id', $category->id)->get();
        $listcategory = Category::get();
        $title = $category->name;
        return view('layouts.category', compact('category', 'posts', 'title', 'listcategory'));
    }
}
