<?php

namespace App\Http\Controllers\RestApis\Auth;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponse;

    public function store(Request $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if (!auth()->attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = auth()->user();
        $token = $user->createToken('api-token')->plainTextToken;

        return $this->apiResponse(function() use ($user, $token) {
            return [
                'user' => $user,
                'token' => $token
            ];
        });
    }
}
