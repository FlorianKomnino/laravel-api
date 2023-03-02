<?php

namespace Database\Seeders;

use App\Models\Admin\Project;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Storage;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 50; $i++) {
            $newProject = new Project();
            $newProject->type_id = Type::inRandomOrder()->first()->id;
            $newProject->author = $faker->word();
            $newProject->title = $faker->sentence(5);
            $newProject->content = $faker->text(500);
            $newProject->topic = $faker->sentence(3);
            $newProject->project_date = $faker->dateTimeBetween('-1 year', 'today');
            $newProject->image = $faker->unique()->imageUrl();
            $newProject->save();
        }
    }
}
