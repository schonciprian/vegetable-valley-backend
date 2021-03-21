<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getUserBasic()
    {
        $user = Auth::user();
        return response([
            "id" => $user->id,
            "first_name" => $user->first_name,
            "last_name" => $user->last_name,
            "username" => $user->username,
            "email" => $user->email,
            "created_at" => $user->created_at], 201);
    }

    public function updateUser(Request $request)
    {
        User::where('id', $request->id)
            ->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
        ]);
        return response(['username' => $request->user()->username], 201);
    }

    public function deleteUser(Request $request)
    {
        User::where('id', $request->id)
            ->delete();

        $request->user()->currentAccessToken()->delete();

        return response("User deleted", 201);
    }
}
