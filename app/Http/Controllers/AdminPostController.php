<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Post::paginate(50)
        ]);
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store()
    {
        //request()->user()->posts()->create();
        Post::create(array_merge($this->validatePost(), [
            'user_id' => request()->user()->id,
            //'thumbnail' => request()->file('thumbnail')->store('thumbnails')
        ]));

        return redirect('/')->with('success', 'Post Created!');;
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', ['post' => $post]);
    }

    public function update(Post $post)
    {
        $attributes = $this->validatePost($post);

        /*if ($attributes['thumbnail'] ?? false) { //php 8 way
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }*/

        $post->update($attributes);

        return back()->with('success', 'Post Updated!');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return back()->with('success', 'Post Deleted!');
    }

    protected function validatePost(?Post $post = null): array //?Post $post = null mean null can be pass to this method
    {
        $post ??= new Post(); // if we have post we're gonna use it, otherwise let set default to new instance 

        return request()->validate([
            'title' => 'required',
            //'thumbnail' => $post->exists ? ['image'] : ['required', 'image'],
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            //'published_at' => 'required'
        ]);
    }
}
