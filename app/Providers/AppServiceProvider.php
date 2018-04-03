<?php

namespace Corp\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // @set($i,1)
        Blade::directive('set', function ($str){
            list($var,$value) = explode(',' , $str);
            return "<?php $var = $value; ?>";
        });

        DB::listen(function ($query){
            echo '<h4>'.$query->sql.'</h4>';
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
