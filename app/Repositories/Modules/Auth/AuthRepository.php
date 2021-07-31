<?php

namespace App\Repositories\Modules\Auth;

use App\Repositories\Repository;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AuthRepository extends Repository
{

    public function login($req)
    {
        $user = User::where('email', $req->input('email'))->first();

        if ($user && Hash::check($req->input('password'), $user->password)) {
            $user->update(['last_login' => Carbon::now()]);
            return $this->getUserToken($user);
        }

        custom_error(['error' => "Invalid Credential"]);
    }


    public function register($req)
    {
        $user = User::create(
            [
                'name' => $req->input('name'),
                'email' => $req->input('email'),
                'password' => Hash::make('password')
            ]
        );
        return $this->getUserToken($user);
    }


    public function forgotPassword()
    {
        return false;
    }


    public function getUserToken(User $user)
    {
        return [
            'user' => $user,
            'token' => $user->createToken('nova')->accessToken
        ];
    }
}
