<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Str;
class GenerateUsername
{
    public function execute(): string
    {
        $username = Str::random(8);

        if(User::where('username', $username)->exists()){
            return $this->execute();
        }

        return Str::random(8);
    }
}
