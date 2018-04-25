<?php

use Illuminate\Database\Seeder;
use Corp\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        factory(User::class)->create(['name' => 'user', 'email' => 'user@mail.ru', 'password' => bcrypt('123'), 'login' => 'user']);
        factory(User::class)->create(['name' => 'admin', 'email' => 'admin@test.com', 'password' => bcrypt('123456'), 'login' => 'admin']);

        factory(User::class, 3)->create();
    }
}
