<?php

namespace App\Traits;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

trait LoginTokenGenerator
{
    protected function generateLoginToken(User $user): string
    {
        $plainToken = Str::random(60);
        $user->login_token = Hash::make($plainToken);
        $user->token_expires_at = Carbon::now()->addHour(24);
        $user->save();
        return $plainToken;
    }
}
