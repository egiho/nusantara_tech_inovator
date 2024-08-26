<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserInfoController extends Controller
{
    public function show()
    {
        return view('info');
    }

    public function update(Request $request)
    {
        // Logic for updating user info
        return response()->json(['message' => 'User info updated successfully!']);
    }
    // Method untuk mendapatkan informasi pengguna
    public function getUserInfo()
    {
        $user = Auth::user();
        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'birthday' => $user->birthday,
            'gender' => $user->gender,
        ]);
    }

    // Method untuk memperbarui informasi pengguna
    public function updateUserInfo(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'birthday' => 'required|date',
            'gender' => 'required|in:male,female',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }

        // Update informasi pengguna
        $user->update([
            'name' => $request->name,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'User info updated successfully!',
        ]);

       

        // public function show()
        // {
        //     return view('info');
        // }

    }
}
