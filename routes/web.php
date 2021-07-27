<?php

use App\Http\Controllers\userController;
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
    return view('home');
});

Route::get('/dashboard', function () {
    return view('App.client.home');
})->middleware(['auth'])->name('dashboard');

Route::resource('/User', userController::class);

Route::get('/account', function (){
    return view('App.client.Account');
});

Route::get('/project', function (){
    return view('App.client.Project');
});

Route::get('/contractor', function (){
    return view('App.client.Contractor');
});

require __DIR__.'/auth.php';

