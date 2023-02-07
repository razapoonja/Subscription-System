<?php

namespace App\Http\Controllers;

use App\Events\PostCreated;
use Request;
use App\Models\{
    Website
};

class PostController extends Controller
{
    public function store(Website $website)
    {
        $attributes = Request::validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string']
        ]);

        $post = $website->posts()->create([
            'title' => $attributes['title'],
            'description' => $attributes['description']
        ]);

        event(new PostCreated($website, $post));

        return response()->json([
            'message' => 'Post created successfully',
            'data' => [
                'post' => $post,
            ]
        ], 200);
    }
}
