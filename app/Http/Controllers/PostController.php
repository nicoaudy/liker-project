<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Events\PostWasCreated;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request, Post $post)
    {
        return $post->with('user')->latestFirst()->get();
    }

    public function store(Request $request)
    {
        $valid = $this->validate($request, [
            'body'  => 'required'
        ]);

        $post = $request->user()->posts()->create($valid);

        // when the post was created event handling and broadcast to other people
        broadcast(new PostWasCreated($post))->toOthers();

        return $post->load('user');
    }
}
