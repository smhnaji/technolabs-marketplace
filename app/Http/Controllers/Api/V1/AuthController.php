<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\AuthRegisterRequest;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Controllers\Api\V1\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(AuthRegisterRequest $request)
    {
        $response = [];

        $userData = $request->validated();
        $userData['password'] = bcrypt($request['password']);

        $user = User::create($userData);

        $response['token'] = $user->createToken($request->device ?? 'Default device')->plainTextToken;

        return $this->responseSuccess($response, 'User registered successfully.');
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(AuthLoginRequest $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            $response = [];
            $response['token'] = $user->createToken($request->device ?? 'Default device')->plainTextToken;
            $response['name'] = $user->name;

            return $this->responseSuccess($response, 'User logged in successfully.');
        } else {
            return $this->responseFailure('Unauthorised.', ['error' => 'Unauthorised'], 403);
        }
    }
}
