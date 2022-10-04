<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        $user = User::create([
            'name'      => $request->name,
            'surname'   =>$request->surname,
            'email'     => $request->email,
            'password'  => Hash::make($request->password)
        ]);
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user'          => $user,
            'access_token'  => $token,
            'token_type'    => 'Bearer',
            ]);

    }

    public function login(LoginUserRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password')))
        {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;


        return response()->json([
            'user'          => $user,
            'access_token'  => $token,
            'token_type'    => 'Bearer',
            ]);

    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response(null, 200);
    }
}
