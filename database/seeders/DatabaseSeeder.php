<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            LanguageSeeder::class,
            CategorySeeder::class,
            CompanySeeder::class,
            MedicineTypeSeeder::class,
            MedicineSeeder::class,
            MedicineDetailSeeder::class,
            ProfileSeeder::class,
            AdminSeeder::class,
            ModeratorSeeder::class,
        ]);

        if (config('app.env') !== 'production') {
            $this->call([
                UserSeeder::class,
            ]);
        }
    }
}
