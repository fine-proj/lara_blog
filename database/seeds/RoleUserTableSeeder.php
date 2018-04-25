<?php

use Illuminate\Database\Seeder;
use Corp\RoleUserRelation;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoleUserRelation::truncate();

        factory(RoleUserRelation::class)->create([
            'user_id' =>  '1',
            'role_id' =>  '1',
        ]);
        factory(RoleUserRelation::class)->create([
            'user_id' =>  '2',
            'role_id' =>  '1',
        ]);
    }
}
