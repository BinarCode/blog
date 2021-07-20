<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeed extends Seeder
{
    public function run()
    {
        User::create([
            'first_name' => 'Vasile',
            'last_name' => 'Papuc',
            'email' => 'vasile.papuc@binarcode.com',
            'password' => Hash::make('secret!'),
        ]);
    }
}
