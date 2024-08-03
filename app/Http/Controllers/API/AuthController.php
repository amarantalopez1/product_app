<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\AccessToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = [
            'name' => $request->input('name'),
            'password' => $request->input('password')
        ];

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
        $user = auth()->user();
        AccessToken::create([
            'user_id' => $user->id,
            'token' => $token,
        ]);
    
        return response()->json(['token' => $token]);
    }
    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::parseToken());
            return response()->json(['message' => 'Token successfully invalidated'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to invalidate the token'], 500);
        }
    }

}