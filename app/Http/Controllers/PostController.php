<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('posts', [
            'posts' => Post::latest()->filter(request(['search', 'category']))->get(), //filter(request->only('search'))
            'categories' => Category::all(),
            'currentCategory' => Category::where('slug', request('category'))->first()
            //'currentCategory' => Category::firstWhere('slug', request('category'))
        ]);
    }

    public function show(Post $post)
    {
        return view('post', [
            'post' => $post
        ]);
    }
}
