<?php

use Illuminate\Database\Seeder;
use Corp\PermissionRoleRelation;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PermissionRoleRelation::truncate();

        factory(PermissionRoleRelation::class)->create([
            'role_id' =>  '1',
            'permission_id' =>  '1',
        ]);
        factory(PermissionRoleRelation::class)->create([
            'role_id' =>  '1',
            'permission_id' =>  '2',
        ]);
        factory(PermissionRoleRelation::class)->create([
            'role_id' =>  '1',
            'permission_id' =>  '3',
        ]);
        factory(PermissionRoleRelation::class)->create([
            'role_id' =>  '1',
            'permission_id' =>  '4',
        ]);
        factory(PermissionRoleRelation::class)->create([
            'role_id' =>  '1',
            'permission_id' =>  '5',
        ]);
        factory(PermissionRoleRelation::class)->create([
            'role_id' =>  '1',
            'permission_id' =>  '6',
        ]);
        factory(PermissionRoleRelation::class)->create([
            'role_id' =>  '1',
            'permission_id' =>  '7',
        ]);
    }
}
