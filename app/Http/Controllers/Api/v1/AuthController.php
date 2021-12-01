<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends ApiController
{
    const INVALID_CREDENTIALS = 'Invalid credentials';

    /**
     * Register a new user.
     * @param \App\Http\Requests\CreateUserRequest $request
     * @return mixed
     */
    public function register(CreateUserRequest $request)
    {
        /** @var $user User */
        $user = User::create([
            'email'    => $request->email,
            'name'     => $request->name,
            'password' => Hash::make($request->password),
        ]);

        return $this->sendResponse($user->getAttributes(), 'Ok', 201);
    }

    /**
     * Login. Getting a token
     *
     * @param \App\Http\Requests\LoginRequest $request
     * @return mixed
     */
    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->all())) {
            return $this->sendError(self::INVALID_CREDENTIALS);
        }

        $accessToken = Auth::user()->createToken('auth_token')->plainTextToken;
//        Auth::user()->tokens()->delete();

        return $this->sendResponse(['token' => $accessToken], 'Ok', 200);
    }
}
