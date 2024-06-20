<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HospitalType;

class HospitalTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $hospitalTypes = [
            'Public', 'Privée'
        ];

        foreach ($hospitalTypes as $type) {
            HospitalType::create(['type' => $type]);
        }
    }
}
