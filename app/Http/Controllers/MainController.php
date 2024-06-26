<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $posts = Post::with('tag')->where('title', 'LIKE', '%' . $keyword . '%')
            ->where('published', true)
            ->orderBy('created_at', 'desc')
            ->get();
        $title = 'Home';
        return view('layouts.index', compact('posts', 'title'));
    }


    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        // $title = $category->name;

        return view('layouts.details', compact('post'));
    }


    public function details($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $tags = $post->tag->pluck('id')->toArray();
        $listcategory = Category::all();
        $taglist = Tag::take(20)->get();
        $related = Post::whereHas('tag', function ($q) use ($tags) {
            $q->whereIn('tags.id', $tags);
        })->where('id', '!=', $post->id)
            ->inRandomOrder()
            ->take(4)
            ->get();
        return view('layouts.details', compact('post', 'related', 'taglist', 'listcategory'));
    }



    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = Post::where('category_id', $category->id)->get();
        $listcategory = Category::get();
        $title = $category->name;
        return view('layouts.category', compact('category', 'posts', 'title', 'listcategory'));
    }

    public function tags($name)
    {
        $tag = Tag::where('name', $name)->firstOrFail();

        $posts = $tag->posts()->paginate(10);

        $taglist = Tag::take(20)->get();

        $listcategory = Category::all();

        $title = 'Posts tagged with ' . $tag->name;

        return view('layouts.search', compact('tag', 'posts', 'taglist', 'listcategory', 'title'));
    }


    public function search(Request $request)
    {
        $keyword = $request->keyword;

        if (empty($keyword)) {
            return redirect()->back()->withErrors('Please enter a keyword to search.');
        }
        $query = Post::query();
        $query->where('title', 'LIKE', '%' . $keyword . '%')
            ->orWhereHas('category', function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%');
            })
            ->orWhereHas('tag', function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%');
            });

        $posts = $query->with('tag', 'category')->paginate(4);
        if ($posts->isEmpty()) {
            $title = 'Hasil Pencarian Tidak Ditemukan';
        } else {
            $title = 'Hasil Pencarian untuk: ' . $keyword;
        }
        $taglist = Tag::take(20)->get();
        $listcategory = Category::all();
        return view('layouts.search', compact('posts', 'title', 'listcategory', 'keyword', 'taglist'));
    }
}
