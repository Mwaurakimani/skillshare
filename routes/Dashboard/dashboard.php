<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

/*
|All Dashboard related link
*/

//backend



Route::get('/dashboard', [DashboardController::class,'Route_Dashboard'])
    ->middleware(['auth'])
    ->name('Dashboard');

Route::get('/account', [DashboardController::class,'Route_Account'])
    ->middleware(['auth'])
    ->name('Account');



