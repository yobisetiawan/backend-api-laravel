<?php

namespace App\Repositories\Modules\Account;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\Repository;


class UserRepository extends Repository
{

    public function getList()
    {
        return UserResource::collection(User::with(['avatar', 'roles'])->get());
    }
}
