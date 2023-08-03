<?php

namespace Database\Seeders;

use App\Models\MedicineDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicineDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MedicineDetail::factory(5)->create();
    }
}
