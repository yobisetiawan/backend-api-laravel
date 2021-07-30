<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->input('email'))->first();

        $valid = $user && Hash::check($request->input('password'), $user->password);

        if ($valid) {
            return ['token' =>  $user->createToken('nova')->accessToken];
        }

        return ['error' =>  'Invalid Credential'];
    }

    public function register()
    {
        return User::updateOrCreate(
            ['email' => 'yobi.studio@gmail.com'],
            ['name' => 'yobi bina setiawan', 'password' => Hash::make('password')]
        );
    }

    public function forgotPassword()
    {
        return 'forgotPassword';
    }
}
