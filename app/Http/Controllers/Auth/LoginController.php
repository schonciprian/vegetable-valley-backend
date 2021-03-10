<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function store(Request $request): Response
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $validation = Validator::make($request->all(), $rules);
        if ($validation->fails()) {
            return response($validation->errors(), 400);
        }

        if (auth()->attempt($request->all())) {
            $token = $request->user()->createToken("VegetableValley");
            return response(['token' => $token->plainTextToken, 'name' => $request->user()->name], 201);
        }
        return response("Authentication failed", 400);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response("Logout success", 204);
    }
}
