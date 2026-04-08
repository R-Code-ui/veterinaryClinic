<?php

namespace Database\Seeders;

use App\Models\MedicalRecord;
use Illuminate\Database\Seeder;

class MedicalRecordSeeder extends Seeder
{
    public function run()
    {
        MedicalRecord::factory()->count(15)->create();
    }
}
