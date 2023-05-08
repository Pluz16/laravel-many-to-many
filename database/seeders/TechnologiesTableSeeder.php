<?php

namespace Database\Seeders;
use App\Models\Technology;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologiesTableSeeder extends Seeder
{
    public function run()
    {
        $technologies = ['CSS', 'JS', 'Vue', 'SQL', 'PHP', 'Laravel'];

        foreach ($technologies as $technology) {
            Technology::create([
                'name' => $technology
            ]);
        }
    }
}
