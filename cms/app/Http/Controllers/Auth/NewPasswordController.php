<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class NewPasswordController extends Controller
{
     /**
     * Show the password reset form.
     */
    public function create($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    /**
     * Handle an incoming new password request.
     */
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        // Reset password
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->password = Hash::make($request->password);
                $user->setRememberToken(Str::random(60));
                $user->save();
            }
        );

        // Jika berhasil, redirect ke halaman login dengan pesan sukses
        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', __($status));
        }

        // Jika gagal, kembalikan pesan error
        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }
}
