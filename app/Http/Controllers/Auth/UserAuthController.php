<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    /**
     * Create new user
     *
     * @param UserRegisterRequest $request
     * @return \Illuminate\Http\Response
     */
    public function register(UserRegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($request->password);

        $user = User::create($data);

        $token = $user->createToken('API Token')->accessToken;

        return response([
            'user' => UserResource::make($user),
            'token' => $token
        ], 201);
    }


    /**
     * @param UserLoginRequest $request
     * @return \Illuminate\Http\Response
     */
    public function login(UserLoginRequest $request)
    {
        $data = $request->validated();

        if (!auth()->attempt($data)) {
            return response(['error_message' => __('auth.failed')]);
        }

        $token = $request->user()->createToken('API Token')->accessToken;

        return response([
            'user' => UserResource::make($request->user()),
            'token' => $token
        ]);

    }
}
