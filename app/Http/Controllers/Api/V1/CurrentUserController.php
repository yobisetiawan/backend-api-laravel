<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CurrentUserController extends Controller
{

    public function show()
    {
        return Auth::user();
    }

    public function update()
    {
        return 'update';
    }

    public function changePassword()
    {
        return 'changePassword';
    }
}
