<?php

use Illuminate\Database\Seeder;

use Corp\Filter;

class FiltersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Filter::truncate();

        factory(Filter::class)->create(['title' => 'Brand Identity', 'alias' => 'brand-identity']);

        factory(Filter::class, 2)->create();
    }
}
