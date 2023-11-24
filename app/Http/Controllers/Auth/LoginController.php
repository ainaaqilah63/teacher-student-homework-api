<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $userWithRole = $this->checkUserRole($credentials);

        $guard = null;
        $tokenName = '';

        if ($userWithRole['role'] == 'Teacher') {
            $guard = 'teacher';
            $tokenName = 'teacher-token';
        } elseif ($userWithRole['role'] == 'Student') {
            $guard = 'student';
            $tokenName = 'student-token';
        }

        if ($guard && Auth::guard($guard)->attempt($credentials)) {
            $token = auth($guard)->user()->createToken($tokenName,)->plainTextToken;

            return response()->json(['token' => $token]);
        } else {
            return response()->json(['message' => 'Authentication failed'], 401);
        }
    }

    private function checkUserRole($credentials)
    {
        $user = User::where('username', $credentials['username'])->with('role')->firstOrFail();
        $credentials['role'] = $user->role->name;

        return $credentials;
    }
}
