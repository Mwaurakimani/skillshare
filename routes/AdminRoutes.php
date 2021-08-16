<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


Route::get('/Admin/Accounts', [AdminController::class,'Accounts_show']);
Route::get('/Admin/Accounts/{id}', [AdminController::class,'Accounts_edit']);

Route::get('/Admin/Projects', [AdminController::class,'Projects_show']);

Route::get('/Admin/Contractors', [AdminController::class,'Contractors_show']);

Route::get('/Admin/Skills', function (){
    return redirect()->route('skills');
});





