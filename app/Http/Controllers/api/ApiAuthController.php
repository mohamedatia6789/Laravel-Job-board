<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // تحديد guard الـ api لاستخراج التوكين
        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'access_token' => $token,
            'expires_in'   => Auth::guard('api')->factory()->getTTL() * 60,
            'token_type'   => 'bearer',
        ]);
    }
    public function profile(){
        $user = Auth::guard('api')->user();
        return response()->json($user);
    }
    public function refresh()
    {
        $newToken = Auth::guard('api')->refresh();

        return response()->json([
            'access_token' => $newToken,
            'expires_in'   => Auth::guard('api')->factory()->getTTL() * 60,
            'token_type'   => 'bearer',
        ]);
    }
    public function logout()
    {
        Auth::guard('api')->logout();

        return response()->json([
            'status'  => true,
            'message' => 'Successfully logged out'
        ]);
    }

}


