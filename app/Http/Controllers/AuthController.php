<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\AuthResource;
use App\Http\Resources\SimpleResource;
use App\Repositories\User\UserRepository;

class AuthController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(LoginRequest $request)
    {
        $user = $this->userRepository->login($request->email, $request->password);

        if (!$user) return new SimpleResource(['message' => 'Your cordentials are invalid.', 'status_code' => 422]);

        $token = $user->createToken('authenticate')->plainTextToken;
        return new AuthResource(['token' => $token]);
    }

}
