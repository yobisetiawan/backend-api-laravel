<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\Modules\Auth\AuthRepository;


class AuthController extends Controller
{
    private $repo;

    public function __construct()
    {
        $this->repo = new AuthRepository;
    }

    public function login(LoginRequest $req)
    {
        return $this->dbSafe(
            fn () => $this->repo->login($req),
            fn ($data) => $data,
        );
    }

    public function register(RegisterRequest $req)
    {
        return $this->dbSafe(
            fn () => $this->repo->register($req),
            fn ($data) => $data,
        );
    }

    public function forgotPassword(ForgotPasswordRequest $req)
    {
        return $this->dbSafe(
            fn () => $this->repo->forgotPassword($req),
            fn ($data) => $data,
        );
    }
}
