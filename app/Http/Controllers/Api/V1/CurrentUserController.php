<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Mail\RegisterMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CurrentUserController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        Mail::to($user->email)->send(new RegisterMail);
        return Auth::user();
    }

    public function update()
    {
        return 'udpate';
    }
}
