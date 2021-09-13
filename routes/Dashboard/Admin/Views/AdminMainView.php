<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
|All Admin related Views
*/

//Admin

Route::get('/Admin/Accounts', [AdminController::class,'Accounts_show'])
    ->middleware(['auth'])
    ->name('AdminAccounts');;

Route::get('/Admin/Accounts/{id}', [AdminController::class,'Accounts_edit'])
    ->middleware(['auth'])
    ->name('AdminAccountsForm');

Route::get('/Admin/Projects', [AdminController::class,'Projects_show'])
    ->middleware(['auth'])
    ->name('AdminProjects');

Route::get('/Admin/Contractors', [AdminController::class,'Contractors_show'])
    ->middleware(['auth'])
    ->name('AdminContractors');

Route::get('/Admin/Skills', [AdminController::class,'Skills_show'])
    ->middleware(['auth'])
    ->name('AdminSkill');

