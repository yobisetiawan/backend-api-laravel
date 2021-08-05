<?php

namespace App\Repositories\Modules\Mail;

use App\Mail\ForgotPasswordMail;
use App\Mail\RegisterMail;
use App\Models\Token;
use App\Models\User;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Mail;

class AuthMailRepository extends Repository
{

    public function sendRegisterEmail(User $user, Token $token)
    {
        return Mail::to($user->email)->send(new RegisterMail($user, $token));
    }

    public function sendForgotPasswordEmail(User $user, Token $token)
    {
        return Mail::to($user->email)->send(new ForgotPasswordMail($user, $token));
    }

    public function sendUpdatedPasswordEmail(User $user)
    {
        return $user;
    }

    public function sendEmailUpdatedEmail(User $user)
    {
        return $user;
    }
}
