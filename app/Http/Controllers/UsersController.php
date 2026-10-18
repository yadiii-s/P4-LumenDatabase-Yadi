<?php

namespace App\Http\Controllers;

use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::OrderBy("id", "DESC")->paginate(10);

        return response()->json($users, 200);
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(["message" => "Data not found"], 404);
        }

        return response()->json($user, 200);
    }
}
