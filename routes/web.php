<?php

use Illuminate\Support\Facades\Route;

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

    Route::get('/', function () {
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            die("Could not connect to the database.  Please check your configuration. error:" . $e );
        }
        return view('welcome');
    });

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');


    //work with collections
    Route::group(['prefix'=>'digging_deeper'],function (){
        Route::get('collections','DiggingDeepController@collections')
        ->name('digging_deeper.collection');
    });
    //work with patterns
        //work with property container
    Route::group(['prefix'=>'patterns'],function (){
        Route::get('PropertyContainer','DiggingDeepController@PropertyContainer')
            ->name('patterns.propertyContainer');
    });
        //work with delegation
    Route::group(['prefix'=>'patterns'],function (){
        Route::get('EventChannel','DiggingDeepController@EventChannel')
            ->name('patterns.EventChannel');
    });
        //work with delegation
    Route::group(['prefix'=>'patterns'],function (){
        Route::get('delegation','DiggingDeepController@Delegation')
            ->name('patterns.Delegation');
    });


    //страница постов
    Route::group(['namespace'=>'Blog','prefix'=>'blog'], function(){
        Route::resource('posts','PostController')->names('blog.posts');
    });

    //Админка блога
    $groupData=[
        'namespace' => 'Blog\Admin',
        'prefix' => 'admin/blog'
    ];
    Route::group($groupData, function(){

        //BlogCategory
        $methods=['index','edit','update','create','store'];
        Route::resource('categories','CategoryController')
        ->only($methods)
        ->names('blog.admin.categories');

        //Posts
        Route::resource('posts','PostController')
            ->except(['show'])
            ->names('blog.admin.posts');
    });


