<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Type;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'Web Development',
            'Mobile Development',
            'Game Development',
            'Desktop Application Development',
        ];

        foreach ($types as $type) {
            Type::create([
                'name' => $type,
                'slug' => Str::slug($type)
            ]);
        }
    }
}

