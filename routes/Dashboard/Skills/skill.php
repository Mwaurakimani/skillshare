<?php

use App\Models\Skill;
use App\Http\Controllers\SkillController;

Route::resource('/Skill', \App\Http\Controllers\SkillController::class)->middleware(['auth']);

Route::post('/addNewSkill', [SkillController::class, 'store'])
    ->middleware(['auth'])
    ->name('skills');;

Route::get('/Skills', [SkillController::class,'list_skills'])
    ->middleware(['auth'])
    ->name('listSkills');

Route::post('/getSkill', [SkillController::class, 'get_Skill'])
    ->middleware(['auth'])
    ->name('getSkills');;

Route::post('/searchSkill', [SkillController::class,'search_skill'])
    ->middleware(['auth'])
    ->name('searchSkills');

Route::post('/addSkillToProject', [SkillController::class,'add_skill_to_project'])
    ->middleware(['auth'])
    ->name('addSkillToProject');

Route::post('/addSkillToUser', [SkillController::class,'add_skill_user'])
    ->middleware(['auth'])
    ->name('addSkillToUSer');

Route::post('/removeSkill', [SkillController::class,'remove_skill_from_project'])
    ->middleware(['auth'])
    ->name('removeSkillFormProject');


