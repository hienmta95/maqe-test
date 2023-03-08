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
    return view('maqe');
});

Route::post('/test', function () {
    return response([
        'success' => true,
        'message' => 'Post success',
        'data' => request()->pin

    ], 200);
})->name('post.test');

Route::post('/maqe', 'App\Http\Controllers\MaqeController@index')->name('post.maqe');
