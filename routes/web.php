<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
// Authentication Routes
Auth::routes(['register' => false]);

// Route::get('/', function () {
//     return view('profil');
// });


Route::get('/', 'HomeController@index');

Route::get('/vue', 'HomeController@coba');


Route::prefix('/news')->group(function () {
        Route::get('', 'home\Newspage@index');
        Route::get('/detail/{id}', 'home\Newspage@show');
        Route::get('/category/{category}', 'home\Newspage@index');
       
});




Route::group(['middleware' => ['auth'] ], function () {
        //  Route::auth();


        Route::group(['middleware' => ['Checkroles:super admin,owner,admin']], function () {
                Route::get('/dashboard', 'Dashboard@index')->name('dashboard');
                Route::get('/listuser', 'Usercontroller@index');
                Route::get('/adduser', 'Usercontroller@create');
                Route::post('/adduser', 'Usercontroller@store');
                Route::get('/edituser/{id}', 'Usercontroller@show');
                Route::put('/edituser/{id}', 'Usercontroller@update');
                Route::get('/deleteuser/{id}', 'Usercontroller@destroy');

                Route::get('/listbrand', 'brandcontroller@index');
                Route::get('/listdata', 'brandcontroller@listdata');
                Route::post('/savebrand', 'brandcontroller@store');
                Route::get('/deletebrand/{id}', 'brandcontroller@destroy');
                Route::get('/updatebrand', 'brandcontroller@show');

                Route::get('/listsubbrand', 'subbrandcontroller@index');
                Route::get('/listdatasubbrand', 'subbrandcontroller@listsubbrand');
                Route::post('/savesubbrand', 'subbrandcontroller@store');
                Route::get('/deletesubbrand/{id}', 'subbrandcontroller@destroy');
                Route::get('/updatesubsbrand', 'subbrandcontroller@show');


                Route::get('/listmenu', 'Module@index');
                Route::get('/listGroup', 'Module@listGroup');
                Route::get('/editgroup/{id}', 'Module@editgroup');
                Route::get('/delgroup/{id}', 'Module@destroy');
                Route::post('/savegroup', 'Module@savegroup');


                Route::get('/listmodule', 'MenuController@index');
                Route::get('/moduledata', 'MenuController@listdata');
                Route::post('/savemodule', 'MenuController@store');
                Route::get('/delmodule/{id}', 'MenuController@destroy');
                Route::get('/editmodule/{id}', 'MenuController@edit');

                Route::get('/addnews', 'NewsController@index');
                Route::post('/addnews', 'NewsController@store');
                Route::get('/listnews', 'NewsController@listnews');
                Route::get('/newsdata', 'NewsController@newsdata');
                Route::get('/editnews/{id}', 'NewsController@edit');
                Route::get('/delnews/{id}', 'NewsController@destroy');
                Route::get('/tagit', 'NewsController@tagit');


                Route::get('news/imagemanager', 'NewsController@imagemanager');
                Route::post('news/uploadimage', 'NewsController@uploadimage');

                Route::get('newscategory', 'NewsCategory@index');
                Route::get('newscategory/listdata', 'NewsCategory@listdata');
                Route::post('newscategory/created', 'NewsCategory@store');
                Route::get('/editcategory/{id}', 'NewsCategory@edit');
                Route::get('/deletecategory/{id}', 'NewsCategory@destroy');
    });

});

Route::group(['middleware' => 'auth'], function () {
        Route::get('chat', 'ChatController@index');
        Route::get('messages', 'ChatController@getMessages');
        Route::post('messages', 'ChatController@broadcastMessage');
});


Route::get('wrt', 'WrtCamera@index');
Route::post('wrt', 'WrtCamera@uploadimg');

Route::get('auth/google', 'GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'GoogleController@handleGoogleCallback');
//Route::get('/login', 'Auth\LoginController@login')->name('login')->middleware('guest');

// Route::post('/loginPost', 'Auth\LoginController@authenticate');


// Route::get('/register', 'AuthController@register');
// Route::post('/registerPost', 'AuthController@registerPost');
// Route::get('/logout', 'AuthController@logout');





Route::post('/vue/login', 'Vue\Authvue@login');
