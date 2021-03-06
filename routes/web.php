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

Route::get('/articles/cat/{cat_alias?}', ['uses'=>'ArticlesController@index',
                                                'as' => 'articlesCat' ]
)->where('cat_alias', '[\w-]+');

Route::resource('/comment', 'CommentController',['only' => ['store'] ]);

Route::match(['get','post'], '/contacts', ['uses'=>'ContactsController@index',
    'as' => 'contacts' ]);

/////////////////////////////////////
//auth
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');

Route::post('/login', 'Auth\LoginController@login');

Route::get('/logout', 'Auth\LoginController@logout');

//admin
Route::group(['prefix'=>'admin', 'as' => 'admin.', 'middleware'=>'auth'], function (){
    //маршрут главной страницы админки localhost/admin/
    Route::get('/', ['uses'=>'Admin\IndexController@index', 'as' => 'adminIndex' ]);
    //маршруты, работающие со статьями в админке localhost/admin/articles...
    Route::resource('/articles', 'Admin\ArticlesController');
    //маршруты, работающие с ролями в админке localhost/admin/permissions...
    Route::resource('/permissions', 'Admin\PermissionsController');
    //маршруты, работающие с пунктами  пользовательского меню в админке localhost/admin/menus...
    Route::resource('/menus', 'Admin\MenusController');
    //маршруты, работающие с пользователями в админке localhost/admin/users...
    Route::resource('/users','Admin\UsersController');
});