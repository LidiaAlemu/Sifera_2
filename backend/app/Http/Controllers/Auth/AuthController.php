<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(
        private AuthService $authService
    ) {}

    /**
     * Register a new user
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $this->authService->register($request->validated());

        // Login immediately after registration
        $result = $this->authService->login([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return ApiResponse::created([
            'user' => $result['user'],
            'token' => $result['token'],
        ], 'Registration successful');
    }

    /**
     * Login
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $result = $this->authService->login($request->validated());

        return ApiResponse::success([
            'user' => $result['user'],
            'token' => $result['token'],
        ], 'Login successful');
    }

    /**
     * Staff login (Manager/Admin)
     */
    public function staffLogin(LoginRequest $request): JsonResponse
    {
        $result = $this->authService->staffLogin($request->validated());

        return ApiResponse::success([
            'user' => $result['user'],
            'token' => $result['token'],
        ], 'Staff login successful');
    }

    /**
     * Logout
     */
    public function logout(): JsonResponse
    {
        $this->authService->logout(auth()->user());

        return ApiResponse::success(null, 'Logged out successfully');
    }

    /**
     * Get authenticated user
     */
    public function me(): JsonResponse
    {
        $user = $this->authService->me(auth()->user());

        return ApiResponse::success($user);
    }
}
