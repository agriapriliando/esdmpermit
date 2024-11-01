<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class TokenController extends Controller
{
    public function login(Request $request)
    {
        $validator = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $token = Str::random(60);
        if (Auth::attempt($validator)) {
            User::whereId(Auth::id())->update([
                'api_token' => $token
                // 'api_token' => bcrypt($token)
            ]);
            return response()->json([
                'token' => $token,
                'user' => Auth::user(),
                'message' => 'Login Success',
                'status' => 'success',
                200
            ]);
        } else {
            return response()->json([
                'message' => 'Username atau Password Salah',
                'status' => 'Unauthorized',
                401
            ]);
        }
    }

    public function logout()
    {
        User::whereId(Auth::id())->update([
            'api_token' => ''
        ]);
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return response()->json([
            'status' => 'success',
            'message' => 'Logged Out Successfully',
            200
        ]);
    }
}
