<?php

use Illuminate\Database\Seeder;
use Corp\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();

        factory(Role::class)->create([
            'name' =>  'Admin',
        ]);
        factory(Role::class)->create([
            'name' =>  'Moderator',
        ]);
        factory(Role::class)->create([
            'name' =>  'Guest',
        ]);
    }
}
