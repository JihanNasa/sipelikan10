<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UpdateUsersLogoSeeder extends Seeder
{
    public function run()
    {
        User::whereNull('logo_jabar')->update([
            'logo_jabar' => 'assets/images/logo-jabar.png'
        ]);
    }
}
