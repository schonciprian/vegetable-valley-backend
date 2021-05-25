<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AvailableGardens;
use App\Models\FilledCells;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        FilledCells::where('user_id', $request->id)->delete();
        AvailableGardens::where('user_id', $request->id)->delete();
        User::where('id', $request->id)->delete();

        $request->user()->currentAccessToken()->delete();

        return response("User deleted", 201);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|max:20',
            'new_password_confirmation' => 'required|same:new_password',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response(['message' => 'Current password does not match!'], 400);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response(['success' => 'Password successfully changed!'], 201);
    }

}
