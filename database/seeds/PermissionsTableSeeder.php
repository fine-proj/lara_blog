<?php

use Illuminate\Database\Seeder;
use Corp\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::truncate();

        factory(Permission::class)->create([
            'name' =>  'VIEW_ADMIN',
        ]);
        factory(Permission::class)->create([
            'name' =>  'ADD_ARTICLES',
        ]);
        factory(Permission::class)->create([
            'name' =>  'UPDATE_ARTICLES',
        ]);
        factory(Permission::class)->create([
            'name' =>  'DELETE_ARTICLES',
        ]);
        factory(Permission::class)->create([
            'name' =>  'ADMIN_USERS',
        ]);
        factory(Permission::class)->create([
            'name' =>  'VIEW_ADMIN_ARTICLES',
        ]);
        factory(Permission::class)->create([
            'name' =>  'EDIT_USERS',
        ]);
        factory(Permission::class)->create([
            'name' =>  'VIEW_ADMIN_MENU',
        ]);
        factory(Permission::class)->create([
            'name' =>  'EDIT_MENU',
        ]);
    }
}
