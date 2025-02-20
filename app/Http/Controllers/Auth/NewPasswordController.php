<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        return view('auth.forgot-password', ['request' => $request]);
    }

    /**
     * Handle an incoming email verification request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function checkEmail(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $token = Password::createToken($user);
            return redirect()->back()->with([
                'email_verified' => true,
                'email' => $request->email,
                'token' => $token,
            ]);
        }

        return redirect()->back()->withErrors(['email' => 'No se encontró un usuario con esa dirección de correo electrónico.']);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Password::tokenExists($user, $request->token)) {
            $user->password = Hash::make($request->password);
            $user->save();

            event(new PasswordReset($user));

            return redirect()->route('login')->with('status', 'Contraseña restablecida con éxito.');
        }

        return redirect()->back()->withErrors(['email' => 'El token de restablecimiento de contraseña no es válido o ha expirado.']);
    }
}
