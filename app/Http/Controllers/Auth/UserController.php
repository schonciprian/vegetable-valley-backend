<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getUser()
    {
        $user = Auth::user();
        return response($user, 201);
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
}
