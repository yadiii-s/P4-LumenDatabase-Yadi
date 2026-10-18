<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tag::OrderBy("id", "DESC")->paginate(10);

        return response()->json($tags, 200);
    }

    public function show($id)
    {
        $tag = Tag::find($id);

        if (!$tag) {
            return response()->json(["message" => "Data not found"], 404);
        }

        return response()->json($tag, 200);
    }
}
