<?php

namespace App\Http\Controllers\App;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request) {
        $data = $request->all();
        $user = User::where('email', $data['email'])->first();
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        $token = $user->createToken('user')->plainTextToken;
        $result = [
            'message' => 'Login Successful',
            'token' => $token
        ];
        return response()->json($result);
    }
}