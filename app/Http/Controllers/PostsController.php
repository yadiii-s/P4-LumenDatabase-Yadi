<?php

namespace App\Http\Controllers;

use App\Models\Post;


class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::OrderBy('id', 'desc')->paginate(10);

        $output = [
            'status' => 'success',
            'result' => $posts
        ];
        return response()->json($output, 200);
    }

    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(["message" => "Data not found"], 404);
        }

        return response()->json($post, 200);
    }
}
