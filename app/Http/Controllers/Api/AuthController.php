<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required',
            'api_token' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || $request->api_token != $user->api_token) {
            return response()->json([
               'message' => 'Vermiş olduğunuz bilgiler geçersiz!',
            ], 401);
        }

        return response()->json([
            'message' => 'Başarı ile giriş yapıldı.'
        ],200);
    }

    public function logout(Request $request)
    {
        $user = User::where('id', $request->user()->id)->first();

        if ($user) {
            return response()->json([
                'message' => 'Başarı ile çıkış yapıldı.'
            ],200);
        } else {
            return response()->json([
                'message' => 'Kullanıcı bulunamadı.'
            ],404);
        }
    }
}
