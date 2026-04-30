<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    private const ADMIN_EMAIL = 'admin@gmail.com';
    private const ADMIN_PASSWORD = 'password';

    public function create()
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request)
    {
        $this->ensureDefaultAdminAccount();

        $credentials = $request->safe()->only(['email', 'password']);

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => 'Invalid credentials. Please try again.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('admin.posts.index'));
    }

    private function ensureDefaultAdminAccount(): void
    {
        User::updateOrCreate(
            ['email' => self::ADMIN_EMAIL],
            [
                'name' => 'Admin',
                'password' => Hash::make(self::ADMIN_PASSWORD),
            ]
        );
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('blog.index');
    }
}
