<?php

use Illuminate\Database\Seeder;
use Corp\Slider;

class SlidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Slider::truncate();

        factory(Slider::class)->create([
                'title' => '<h2 style="color:#fff">CORPORATE, MULTIPURPOSE.. <br /><span>PINK RIO</span></h2>',
                'desc' => 'Nam1 id quam a odio euismod pellentesque. Etiam congue rutrum risus non vestibulum. Quisque a diam at ligula blandit consequat. Mauris ac mi velit, a tempor neque',
                'img' => 'xx.jpg',
            ]);
        factory(Slider::class)->create([
            'title' => '<h2 style="color:#fff">PINKRIO. <span>STRONG AND POWERFUL.</span></h2>',
            'desc' => 'Nam2 id quam a odio euismod pellentesque. Etiam congue rutrum risus non vestibulum. Quisque a diam at ligula blandit consequat. Mauris ac mi velit, a tempor neque',
            'img' => '00314.jpg',
        ]);
        factory(Slider::class)->create([
            'title' => '<h2 style="color:#fff">PINKRIO. <span>STRONG AND POWERFUL.</span></h2>',
            'desc' => 'Nam3 id quam a odio euismod pellentesque. Etiam congue rutrum risus non vestibulum. Quisque a diam at ligula blandit consequat. Mauris ac mi velit, a tempor neque',
            'img' => 'dd.jpg',
        ]);

        factory(Slider::class, 2)->create();
    }
}
