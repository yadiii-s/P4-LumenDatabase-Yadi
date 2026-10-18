<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::OrderBy("id", "DESC")->paginate(10);

        return response()->json($categories, 200);
    }

    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(["message" => "Data not found"], 404);
        }

        return response()->json($category, 200);
    }
}
