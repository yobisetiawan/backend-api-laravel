<?php

namespace App\Repositories\Modules\Auth;

use App\Repositories\Repository;
use App\Models\User;
use App\Repositories\Modules\Mail\AuthMailRepository;
use App\Repositories\Modules\Support\TokenRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;


class AuthRepository extends Repository
{

    private $mail;
    private $token;

    public function __construct()
    {
        $this->mail = new AuthMailRepository;
        $this->token = new TokenRepository;
    }

    public function login($req)
    {
        $user = User::where('email', $req->input('email'))->first();

        if ($user && Hash::check($req->input('password'), $user->password)) {

            $user->update(['last_login' => Carbon::now()]);

            return $this->getUserToken($user);
        }

        custom_error(['error' => "Invalid Credential"]);
    }

    public function logout($req)
    {
        if ($user = $req->user()) {
            $user->token()->revoke();
        }
        return ['success' => true];
    }


    public function register($req)
    {
        $user = User::create(
            [
                'name' => $req->input('name'),
                'email' => strtolower($req->input('email')),
                'password' => Hash::make($req->input('password'))
            ]
        );

        $user->assignRole('user');

        $token_obj = $this->token->create($user, 'verify-email');

        $this->mail->sendRegisterEmail($user, $token_obj);

        return $this->getUserToken($user);
    }


    public function forgotPassword($req)
    {
        $user = User::where('email', strtolower($req->input('email')))->firstOrFail();

        $token_obj = $this->token->create($user, 'forgot-password');

        $this->mail->sendForgotPasswordEmail($user, $token_obj);
    }


    public function resetPassword($req, $token)
    {
        $token_obj = $this->token->checkToken($token, 'forgot-password');
        $user = $token_obj->user;

        $user->update([
            'password' => Hash::make($req->input('password'))
        ]);

        $this->token->setTokenActivatedAt($token_obj);

        $this->mail->sendUpdatedPasswordEmail($user);

        return ['success' => true];
    }


    public function getUserToken(User $user)
    {

        $user->tokens()->delete();

        return [
            'user' => $user,
            'token' => $user->createToken('nova')->accessToken
        ];
    }
}
