<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        /**
         * @var User $user
         */
        $user = User::create([
            'name' => 'Default name ' . Carbon::now()->getTimestamp(),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
        $token = $user->createToken('main')->plainTextToken;

        return response()->json(compact([
            'user',
            'token',
        ]));
    }

    public function login(LoginRequest $request)
    {
        $credential = $request->validated();
        if (!Auth::attempt($credential)) {
            return response()->json([
                'message' => 'The provided credentials are not correct',
            ], 422);
        };

        /**
         * @var User $user
         */
        $user = Auth::user();
        $token = $user->createToken('main')->plainTextToken;

        return response()->json(compact([
            'user',
            'token',
        ]));
    }

    public function logout()
    {
        /**
         * @var User $user
         */
        $user = Auth::user();
        $user->currentAccessToken()->delete();

        return response()->json([
            'success' => 'Logged out (づ￣ 3￣)づ',
        ]);
    }
}
