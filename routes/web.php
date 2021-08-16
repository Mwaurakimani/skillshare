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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('App.client.home');
})->middleware(['auth'])->name('dashboard');

Route::resource('/User', userController::class);



//dashboard
Route::get('/account' , function (){

    return view('App.client.home');
})->middleware(['auth'])->name('dashboard_account');


Route::get('/project' , function (){
    $projects = Project::all();

    return view('App.client.Project')->with([
        'projects'=>$projects
    ]);
})->middleware(['auth'])->name('dashboard_project');

Route::get('/project/{id}' , function ($id){
    $projects = Project::find($id);

    return view('App.client.ProjectView')->with([
        'project'=>$projects
    ]);
})->middleware(['auth'])->name('dashboard_project_view');




















require __DIR__.'/auth.php';

