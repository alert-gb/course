<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{

    public function register(RegisterRequest $request)
    {
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->passowrd),
            ]);
            return response()->json(['message' => 'User Registered Successfully', 201], 201);
        } catch (\Exception $exp) {
            return response()->json(['message' => 'There is Unhandeled Problem', 422], 422);
        }
    }


    public function login(Request $request)
    {

        $user = User::where('email', $request->email)->first();

        if ($user || Hash::check($request->password, $user->password)) {
            return $user->createToken("login_token")->plainTextToken;
        } else {
            return response()->json(['message' => 'Credentials Not Match', 422], 422);
        }
    }

    public function logout(Request $request) {
            
    }
}
