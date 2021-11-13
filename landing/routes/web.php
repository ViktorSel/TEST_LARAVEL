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
Route::middleware([App\Http\Middleware\Rpc::class])->group(function(){
    Route::get('/', function (bool $param = false) {
        return view('welcome');
    });

    Auth::routes([
        'register'  => false,
        'login'     => true,
    ]);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/admin/activity/{page?}', [App\Http\Controllers\DataController::class, 'index'])->name('data');
});
