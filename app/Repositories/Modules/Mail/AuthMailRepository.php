<?php

use App\Mail\RegisterMail;
use App\Models\User;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Mail;

class AuthMailRepository extends Repository
{

    public function sendRegisterEmail(User $user)
    {
        return Mail::to($user->email)->send(new RegisterMail);
    }

    public function sendForgotPasswordEmail(User $user)
    {
        return $user;
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
