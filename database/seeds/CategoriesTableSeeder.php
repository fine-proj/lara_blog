<?php

use Illuminate\Database\Seeder;
use Corp\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();

        factory(Category::class)->create(['title' => 'Блог', 'alias' => 'blog', 'parent_id' => '0']);
        factory(Category::class)->create(['title' => 'Компьютеры', 'alias' => 'computers', 'parent_id' => '1']);
        factory(Category::class)->create(['title' => 'Интересное', 'alias' => 'iteresting', 'parent_id' => '1']);
        factory(Category::class)->create(['title' => 'Советы', 'alias' => 'soveti', 'parent_id' => '1']);

        factory(Category::class, 2)->create();
    }
}
