<?php

namespace App\Repositories\Modules\Support;

use App\Models\Token;
use App\Models\User;
use Carbon\Carbon;

class TokenRepository
{
    public function create(User $user, string $purpose, int $expired = 3, $extra = null)
    {
        $expired_at = $expired > 0 ? Carbon::now()->addDays($expired)->toDateTimeString() : null;
        $get_token = null;

        if ($extra == null) {
            $extra = ['email' => $user->email];
        }

        while ($get_token == null) {
            $token = bin2hex(random_bytes(32));
            if (Token::where('token', $token)->count() == 0) {
                $data = [
                    'token' => bin2hex(random_bytes(32)),
                    'active' => true,
                    'purpose' => $purpose,
                    'user_id' => $user->id,
                    'expired_at' => $expired_at,
                    'data' => json_encode($extra),
                ];
                $get_token  = Token::create($data);
            }
        }

        return $get_token;
    }
}
