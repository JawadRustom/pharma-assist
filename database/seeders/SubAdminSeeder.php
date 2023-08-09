<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory([
            'first_name' => 'SubAdmin',
            'last_name' => 'SubAdmin',
            'email' => 'SubAdmin@SubAdmin.com',
            'role_id' => 2,
            'password'=>'password',
            'phone_number'=>987372763,
        ])->create();
    }
}
