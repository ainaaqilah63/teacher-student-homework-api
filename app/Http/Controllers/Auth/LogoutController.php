<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        $token = $request->bearerToken();

        if ($token) {
            Auth::user()->tokens()->where('id', $token)->delete();

            return response()->json(['message' => 'Logout successful']);
        } else {
            return response()->json(['message' => 'Token not provided'], 401);
        }
    }
}
