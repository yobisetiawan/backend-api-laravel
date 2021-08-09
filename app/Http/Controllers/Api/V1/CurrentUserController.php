<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeAvatarRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ChangeProfileRequest;
use App\Repositories\Modules\Account\CurrentUserRepository;
use Illuminate\Http\Request;

class CurrentUserController extends Controller
{

    private $repo;

    public function __construct()
    {
        $this->repo = new CurrentUserRepository;
    }


    public function show(Request $req)
    {
        return $this->dbSafe(
            fn () => $this->repo->show($req),
            fn ($data) => $data,
        );
    }

    public function changePassword(ChangePasswordRequest $req)
    {
        return $this->dbSafe(
            fn () => $this->repo->changePassword($req),
            fn ($data) => $data,
        );
    }

    public function changeAvatar(ChangeAvatarRequest $req)
    {
        return $this->dbSafe(
            fn () => $this->repo->changeAvatar($req),
            fn ($data) => $data,
        );
    }

    public function changeProfile(ChangeProfileRequest $req)
    {
        return $this->dbSafe(
            fn () => $this->repo->changeProfile($req),
            fn ($data) => $data,
        );
    }
}
