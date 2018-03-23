<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});*/

Route::resource('/', 'IndexController',[
        'only'=>['index'], 'names'=>['index'=>'home']
    ]);

Route::resource('/portfolios', 'PortfolioController',
        ['parameters' => ['portfolios'=>'alias'] ]
    );

Route::resource('/articles', 'ArticlesController',
    ['parameters' => ['articles'=>'alias'] ]
);