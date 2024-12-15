<?php

namespace Database\Seeders;

use App\Models\Year;
use Illuminate\Database\Seeder;

class YearSeeder extends Seeder
{
    public function run()
    {
        $currentYear = date('Y');
        for ($year = $currentYear; $year <= $currentYear + 5; $year++) {
            Year::create(['year' => $year]);
        }
    }
}
