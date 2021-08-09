<?php

namespace App\Repositories\Modules\Account;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\Modules\Support\FIleHandleRepository;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Hash;

class CurrentUserRepository extends Repository
{

    public function show($req)
    {
        return new UserResource($this->itemWith($req->user(), ['avatar', 'roles']));
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

        $data = [
            'path' => 'user_' . $user->id . '/avatars/',
            'file_name' => $user->id
        ];

        $handler = new FIleHandleRepository($req->file('file'), $data);

        $handler->resizeImage(200, null, function ($q) {
            $q->aspectRatio();
        });

        $handler->upload('public');

        $handler->store($user, 'avatar');

        return $this->show($req);
    }

    public function changeProfile($req)
    {
        $user = $req->user();

        $user->update($req->only(['name']));

        return $this->show($req);
    }
}
