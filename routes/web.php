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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/restaurants-registration', 'RestaurantRegistrationController@form'); //grabbing data
Route::post('/restaurants-registration', 'RestaurantRegistrationController@register'); //storing data

Route::get('/restaurants', 'RestaurantRegistrationController@index');
Route::get('/restaurant/{id}', 'RestaurantRegistrationController@show');
Route::post('/comment/{id}', 'RestaurantRegistrationController@store');
Route::delete('/comment/{id}', 'RestaurantRegistrationController@delete');
Route::post('/comment-reply/{id}', 'CommentReplyController@store');


