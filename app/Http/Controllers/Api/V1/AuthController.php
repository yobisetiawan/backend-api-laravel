<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Repositories\Modules\Auth\AuthRepository;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $repo;

    public function __construct()
    {
        $this->repo = new AuthRepository;
    }

    public function login(LoginRequest $req)
    {
        return $this->dbSafe(fn () => $this->repo->login($req));
    }

    public function register(RegisterRequest $req)
    {
        return $this->dbSafe(fn () => $this->repo->register($req));
    }

    public function forgotPassword(ForgotPasswordRequest $req)
    {
        return $this->dbSafe(fn () => $this->repo->forgotPassword($req));
    }

    public function resetPassword(ResetPasswordRequest $req, $token)
    {
        return $this->dbSafe(fn () => $this->repo->resetPassword($req, $token));
    }

    public function logout(Request $req)
    {
        return $this->dbSafe(fn () => $this->repo->logout($req));
    }

    public function resendVerifyEmail(Request $req)
    {
        return $this->dbSafe(fn () => $this->repo->resendVerifyEmail($req));
    }

    public function verifyEmail(string $token)
    {
        return $this->dbSafe(fn () => $this->repo->verifyEmail($token));
    }
}
