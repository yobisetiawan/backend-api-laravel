<?php

namespace App\Repositories\Modules\Account;

use App\Repositories\Repository;
use Illuminate\Support\Facades\Hash;

class CurrentUserRepository extends Repository
{

    public function show($req)
    {
        return $req->user();
    }


    public function changePassword($req)
    {
        $user = $req->user();

        if (Hash::check($req->input('old_password'), $user->password)) {
            $user->update([
                'password' => Hash::make($req->input('password'))
            ]);
            return ['success' => true];
        }

        custom_error('Invalid Old Password', 500);
    }

    public function changeAvatar($req)
    {
        $user = $req->user();
        $user->avatar();
        return $user;
    }

    public function changeProfile($req)
    {
        $user = $req->user();
        $user->update($req->only(['name']));
        return $user;
    }
}
