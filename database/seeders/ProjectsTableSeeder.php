<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use App\Models\Project;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
    
        for ($i = 0; $i < 200; $i++) {
            $name = $faker->sentence(3);
            $description = $faker->paragraph(3);
            $url = $faker->url;
            $slug = Str::slug($name);
            $type_id = rand(1, 3);
            $user_id = 1;
    
            Project::create([
                'name' => $name,
                'user_id' => $user_id,
                'description' => $description,
                'url' => $url,
                'slug' => $slug,
                'type_id' => $type_id,
            ]);
        }
    }
    
}
