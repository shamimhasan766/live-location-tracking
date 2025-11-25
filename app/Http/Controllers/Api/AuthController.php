<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        $user = $this->authService->register($request);

        $token = JWTAuth::fromUser($user);
        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'token' => $token
        ]);
    }
}
