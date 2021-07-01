<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\User\UserRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends BaseController
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $repassword = $request->repassword;
        if (User::where('email', '=', $email)->exists()) {
            return $this->sendSuccess('Email has existed!',null, 401);
        } elseif($password != $repassword) {
            return $this->sendSuccess('Confirm password is not true!',null, 401);
        } else {
            $user = $this->userRepository->create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password)
            ]);
            return $this->sendSuccess('User created successfully', $user, 200);
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $token = null;
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return $this->sendSuccess('invalid_email_or_password', [], 422);
            }
        } catch (JWTException $e) {
            return $this->sendSuccess('failed_to_create_token', [], 500);
        }
        return $this->sendSuccess('Token is created', compact('token'), 200);
    }

    public function getUserInfo(Request $request)
    {
        $user = JWTAuth::toUser($request->token);
        return $this->sendSuccess('Information', $user, 200);
    }

    function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);
            return $this->sendSuccess('User logged out successfully!', true, 200);
        } catch (JWTException $e) {
            return $this->sendSuccess('Sorry, the user cannot be logged out', false, 500);
        }
    }
}
