<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $roles = Role::all()->pluck('id');

        $users = User::all();

        foreach ($users as $user) {
            $user->roles()->attach($faker->randomElements($roles, 2));
        }
    }
}
