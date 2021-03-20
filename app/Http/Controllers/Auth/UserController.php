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
            "name" => $user->name,
            "email" => $user->email,
            "created_at" => $user->created_at], 201);
    }

    public function updateUser(Request $request)
    {
        User::where('id', $request->id)
            ->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return response(['name' => $request->user()->name], 201);
    }

    public function deleteUser(Request $request)
    {
        User::where('id', $request->id)
            ->delete();

        $request->user()->currentAccessToken()->delete();

        return response("User deleted", 201);
    }
}
