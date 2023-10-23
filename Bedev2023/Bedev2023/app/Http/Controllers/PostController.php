<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //show all posts
    public function index()
    {
        return view('posts.index', [
            'heading' => 'Latest posts',
            'posts' => Post::latest()->filter(request(['tag', 'search']))->paginate(6) //paginate umisto get zbog paginacije ali ima i simplePaginate koji ima samo next i prev botun
        ]);
    }

    //show single post
    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => User::find($post->user_id)->name
        ]);
    }

    //show create form
    public function create()
    {
        return view('posts.create');
    }

    //store post data
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'location' => 'required',
            'content' => 'required',
            'tags' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('images', 'public');
        }

        $formFields['user_id'] = auth()->id();

        //  'php artisan storage:link' za uciniti storage public dostupnim

        Post::create($formFields);

        return redirect('/')->with('message', 'Post created succesfully!');
    }

    //show edit form
    public function edit(Post $post)
    {
        // make sure logged in user is owner
        if ($post->user_id != auth()->id()) {
            abort('403', 'Unauthorized Action');
        }
        return view('posts.edit', ['post' => $post]);
    }

    //update post data
    public function update(Request $request, Post $post)
    {
        // make sure logged in user is owner
        if ($post->user_id != auth()->id()) { // ovaj uvjet je mozda bilo samo dovoljno staviti u show edit form rutu ali mozda je ovo neka dodatna sigurnost
            abort('403', 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'location' => 'required',
            'content' => 'required',
            'tags' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('images', 'public');
        }

        // 'php artisan storage:link' za uciniti storage public dostupnim

        $post->update($formFields); //umisto Post::create

        return redirect('/')->with('message', 'Post updated succesfully!');
    }

    //delete post
    public function destroy(Post $post)
    {
        // make sure logged in user is owner
        if ($post->user_id != auth()->id()) {
            abort('403', 'Unauthorized Action');
        }
        $post->delete();
        return redirect('/')->with('message', 'Post deleted successfully');
    }

    //manage posts
    public function manage(Post $post, User $user)
    {
        if (auth()->user()->role_id == 1) {
            return view('posts.manage', ['posts' => $post->all()]);
        }
        return view('posts.manage', ['posts' => auth()->user()->posts()->get()]);
    }
}
