<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AvailableGardens;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function store(Request $request): Response
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|max:20',
            'confirm_password' => 'required|min:6|max:20|same:password'
        ];

        $validation = Validator::make($request->all(), $rules);
        if ($validation->fails()) {
            return response($validation->errors(), 400);
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        AvailableGardens::create([
            'user_id' => $user->id,
            'row_count' => 5,
            'column_count' => 6,
        ]);

        return response(["message" => "Registered"], 201);
    }
}
