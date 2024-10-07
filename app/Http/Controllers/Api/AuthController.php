<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum',only: ['logout']),
        ];
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        $token = $user->createToken('token')->plainTextToken;
        if ( $request->profile)
            $user->addMediaFromRequest('profile')
                ->setFileName($user->user_name)
                ->toMediaCollection('profile');

        return $this->successResponse([
                'user' => UserResource::make($user),
                'token' => $token
        ]);
    }

    public function login(LoginRequest $request)
    {
        if (! Auth::attempt($request->validated()))
            return $this->errorResponse('Your email or password is incorrect');

        $user = Auth::user();

        $token = $user->createToken('token')->plainTextToken;

        return $this->successResponse([
                'user' => UserResource::make($user),
                'token' => $token,
            ]);
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        return $this->successResponse(message: 'Logged out');
    }


}
