<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $projectTypes = [
            'front-end', 'back-end', 'full-stack'
        ];
        foreach ($projectTypes as $projectType) {
            $newType = new Type();
            $newType->name = $projectType;
            $newType->save();
        }
    }
}
