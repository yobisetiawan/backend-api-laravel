<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CurrentUserController extends Controller
{

    private $form_type = [
        'change-password' => $this->changePassword;
    ]


    public function show()
    {
        return Auth::user();
    }

    public function update()
    {
        return 'update';
    }

    publi function changePassword(){

    }
}
