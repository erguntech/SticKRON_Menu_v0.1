<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AppUserSeeder extends Seeder
{
    public function run(): void
    {
        $user = new User();
        $user->first_name = "Super";
        $user->last_name = "Admin";
        $user->email = settings('app_email');
        $user->password = Hash::make('10775');
        $user->user_type = 1;
        $user->is_active = true;
        $user->email_verified_at = now();
        $user->remember_token = Str::random(10);
        $user->save();

        $user->api_token = $user->createToken(Str::random(10))->plainTextToken;
        $user->save();
    }
}
