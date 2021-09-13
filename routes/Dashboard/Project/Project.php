<?php


use App\Http\Controllers\ProjectController;



Route::resource('project',ProjectController::class)->middleware(['auth']);

Route::post('/project/complete',[ProjectController::class,'set_project_as_complete'])->middleware(['auth']);

Route::post('/project/rate',[ProjectController::class,'rate_project'])->middleware(['auth']);

Route::get('/Projects/{id}',[ProjectController::class,'get_project_by_id'])->middleware(['auth']);

Route::get('/Projects', [ProjectController::class,'get_all_projects'])->middleware(['auth']);

Route::post('/getProjects', [ProjectController::class,'searchProject'])->middleware(['auth']);



