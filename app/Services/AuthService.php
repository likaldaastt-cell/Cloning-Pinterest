<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }

    public function attemptWeb(array $credentials, bool $remember = false): bool
    {
        return Auth::attempt($credentials, $remember);
    }

    public function loginWeb(User $user): void
    {
        Auth::login($user);
    }

    public function logoutWeb(Request $request): void
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }

    public function verifyCredentials(string $email, string $password): ?User
    {
        $user = User::where('email', $email)->first();
        return $user && Hash::check($password, $user->password) ? $user : null;
    }
}