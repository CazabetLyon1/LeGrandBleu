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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('profile', function () {

})->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('{usr_login}',[
    'uses' => 'UserController@index',
    'as' => 'user-page'
])->where('usr_login','^[a-z]+[.][a-z]+[0-9]*?$');

Route::post('/accounts_images', 'AccountsImagesController@getAllImages')->name('accounts_images');
Route::post('/change_accounts_images', 'UserController@changeUserImage')->name('change_accounts_images');
Route::post('/search_accounts_team', 'UserController@findTeam')->name('search_accounts_team');
Route::post('/change_accounts_team', 'UserController@changeTeam')->name('change_accounts_team');

Route::get('/ClubUpload', 'clubUploadController@index')->name('ClubUpload');
Route::post('/store', 'clubUploadController@store')->name('store');
Route::get('/nbBut', 'clubUploadController@nbBut')->name('nbBut');
