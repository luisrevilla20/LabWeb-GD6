<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShortLinkController;
use App\Http\Controllers\LinkController;

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

Route::resource('links', 'App\Http\Controllers\LinkController');
Route::get('{code}', 'App\Http\Controllers\LinkController@shortenLink')->name('shorten.link');

Route::get('/', function () {
    return redirect('/links');
});


