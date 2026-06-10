<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token', ['*'], now()->addDays(7))->plainTextToken;

        return response()->json([
            'message' => 'Register berhasil',
            'token' => $token,
            'user' => $user
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Email atau password salah'
            ], 401);
        }

        $token = $user->createToken('auth_token', ['*'], now()->addDays(7))->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'token' => $token,
            'user' => $user
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout berhasil'
        ]);
    }

    public function googleRedirect()
    {
        /** @var \Laravel\Socialite\Two\GoogleProvider $provider */
        $provider = Socialite::driver('google');

        $url = $provider->stateless()->redirect()->getTargetUrl();

        return response()->json(['url' => $url]);
    }

    public function googleCallback()
    {
        try {
            /** @var \Laravel\Socialite\Two\GoogleProvider $provider */
            $provider = Socialite::driver('google');

            $socialiteUser = $provider->stateless()->user();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Google authentication failed'], 401);
        }

        $user = User::where('email', $socialiteUser->getEmail())->first();

        if (!$user) {
            $user = User::create([
                'name' => $socialiteUser->getName(),
                'email' => $socialiteUser->getEmail(),
                'google_id' => $socialiteUser->getId(),
                'avatar' => $socialiteUser->getAvatar(),
                'password' => Hash::make(Str::random(32)),
            ]);
        } else {
            $user->update([
                'google_id' => $socialiteUser->getId(),
                'avatar' => $socialiteUser->getAvatar(),
            ]);
        }

        $token = $user->createToken('auth_token', ['*'], now()->addDays(7))->plainTextToken;

        $frontendUrl = env('FRONTEND_URL', 'http://localhost:5173');

        if (request()->expectsJson() || request()->wantsJson()) {
            return response()->json([
                'message' => 'Login Google berhasil',
                'token' => $token,
                'user' => $user
            ]);
        }

        return redirect("$frontendUrl?token=$token");
    }
}