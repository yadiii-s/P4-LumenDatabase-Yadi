<?php

namespace App\Http\Controllers;

use App\Models\Comment;

class CommentsController extends Controller
{
    public function index()
    {
        $comments = Comment::OrderBy("id", "DESC")->paginate(10);

        return response()->json($comments, 200);
    }

    public function show($id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json(["message" => "Data not found"], 404);
        }

        return response()->json($comment, 200);
    }
}
