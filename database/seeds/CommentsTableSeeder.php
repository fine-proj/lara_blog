<?php

use Illuminate\Database\Seeder;
use Corp\Comment;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::truncate();

        factory(Comment::class)->create([
            'text' =>  'OK text text text',
            'name' => 'Ivan Efremov',
            'site' => 'www.google.com',
            'email' => 'qwe@ukr.net',
            'parent_id' => '0',
            'user_id' => null,
            'article_id' => '1',
        ]);
        factory(Comment::class)->create([
            'text' =>  'NOT text text text',
            'name' => '',
            'site' => '',
            'email' => '',
            'parent_id' => '1',
            'user_id' => '1',
            'article_id' => '1',
        ]);
        factory(Comment::class)->create([
            'text' =>  'CANCEL text text text',
            'name' => '',
            'site' => '',
            'email' => '',
            'parent_id' => '2',
            'user_id' => '2',
            'article_id' => '1',
        ]);
        factory(Comment::class)->create([
            'text' =>  'ERR text text text',
            'name' => '',
            'site' => '',
            'email' => '',
            'parent_id' => '0',
            'user_id' => '3',
            'article_id' => '1',
        ]);

        factory(Comment::class, 2)->create();
    }
}
