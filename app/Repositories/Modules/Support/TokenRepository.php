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


    public function checkToken(string $token, string $slug)
    {
        if (!$token = Token::has('user')->where('token', $token)->where('active', true)
            ->where('purpose', $slug)->first()) {
            custom_error('Token Not Found', 404);
        }

        if (!empty($token->expired_at) && Carbon::now() > Carbon::parse($token->expired_at)) {
            custom_error("Token expired", 500);
        }

        return $token;
    }

    public function setTokenActivatedAt(Token $token)
    {
        return $token->update([
            'active' => false,
            'activated_at' => Carbon::now(),
        ]);
    }
}
