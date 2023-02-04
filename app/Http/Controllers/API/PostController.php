<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // all post
    public function allPost()
    {
        $data = Post::get();
        return response()->json([
            'post' => $data,
        ]);
    }

    // search post
    public function postSearch(Request $request)
    {
        $post = Post::where('title', 'LIKE', '%' . $request->key . '%')->get();

        return response()->json([
            'searchData' => $post,
        ]);

    }

    // post details
    public function postDetails(Request $request)
    {
        $post = Post::where('post_id', $request->postId)->first();
        return response()->json([
            'post' => $post,
        ]);
    }
}