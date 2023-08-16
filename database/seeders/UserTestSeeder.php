<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory([
            'first_name' => 'user',
            'last_name' => 'user',
            'email' => 'user@user.com',
            'role_id' => 3,
            'password'=>'password',
            'phone_number'=>987372763,
        ])->create();
    }
}
