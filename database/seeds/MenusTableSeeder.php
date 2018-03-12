<?php

use Illuminate\Database\Seeder;
use Corp\Menu;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::truncate();

        factory(Menu::class)->create(['title' => 'Главная', 'path' => 'http://localhost', 'parent' => 0]);
        factory(Menu::class)->create(['title' => 'Блог', 'path' => 'http://localhost/articles', 'parent' => 0]);
        factory(Menu::class)->create(['title' => 'Компьютеры', 'path' => 'http://localhost/articles/cat/computers', 'parent' => 2]);
        factory(Menu::class)->create(['title' => 'Интересное', 'path' => 'http://localhost/articles/cat/iteresting', 'parent' => 2]);
        factory(Menu::class)->create(['title' => 'Советы', 'path' => 'http://localhost/articles/cat/soveti', 'parent' => 2]);
        factory(Menu::class)->create(['title' => 'Портфолио', 'path' => 'http://localhost/portfolios', 'parent' => 0]);
        factory(Menu::class)->create(['title' => 'Контакты', 'path' => 'http://localhost/contacts', 'parent' => 0]);
    }
}
