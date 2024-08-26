<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class PasswordResetLinkController extends Controller
{
     /**
     * Show the form to request a password reset link.
     */
    public function create()
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     */
    public function store(Request $request)
    {
        // Validasi email
        $request->validate([
            'email' => 'required|email',
        ]);

        // Kirim link reset password
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Cek apakah email berhasil dikirim atau tidak
        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        // Jika gagal mengirimkan, kembalikan pesan error
        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }
}
