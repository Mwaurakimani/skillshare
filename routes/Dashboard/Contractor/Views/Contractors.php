<?php

use App\Http\Controllers\ContractorController;
use App\Http\Controllers\userController;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Project;



Route::get('/contractor/project', [ContractorController::class,'get_projects_applied_for'])->middleware(['auth'])->name('account');


Route::get('/Home/contractor/{id}', [userController::class,'viewContractor'])->middleware(['auth'])->name('account');

Route::get('/Contractor/{id}', [ContractorController::class,'get_contractor_with_applications'])->middleware(['auth'])->name('account');

Route::post('/Contractor/hire', [ContractorController::class,'hire_contractor'])->middleware(['auth'])->name('account');

Route::post('/Contractor/fire', [ContractorController::class,'fire_contractor'])->middleware(['auth'])->name('account');



Route::post('/applyForJob', function (Request $request) {
    $response = false;
    $stmt = "";

    $user_id = $request->user_id;
    $project_id = $request->project_id;

    //user is contracture
    $user = User::where('id', $user_id)->with('Skill')->get();
    $available_skills = [];

    foreach ($user[0]['Skill'] as $key => $value) {
        array_push($available_skills, $value['id']);
    }

    //if no skills then return a fals
    if(count($available_skills) <= 0){
        $response = false;
        $stmt = "You do not meet the minimum requirements to apply for this Project";

        return array(
            "response" => $response,
            "stmt" => $stmt
        );
    }

    //user has the skill
    $project = Project::where('id', $project_id)->with('Skill')->get();

    foreach ($project[0]['Skill'] as $key => $value) {
        if(!in_array($value['id'],$available_skills)){
            $response = false;
            $stmt = "You do not meet the minimum requirements to apply for this Project";
            break;
        }else{
            $response = true;
            $stmt = "Applied Successfully";
        }

    }

    if($response == true){
        $app_test = \App\Models\Application
            ::where('user_id',$user_id)
            ->where('project_id',$project_id)
            ->get();

        if(count($app_test) > 0){
            return array(
                'response' => false,
                'stmt' => 'Already Applied'
            );
        }

        $app = new \App\Models\Application();

        $app->project_id = $project_id;
        $app->user_id = $user_id;

        $app->save();

        return array(
            'response' => true,
            'stmt' => 'Applied Successfully'
        );
    }else{
        return array(
            'response' => $response,
            'stmt' => $stmt
        );
    }
});


Route::get('/Contractors', function () {
    $contractors = User::where('role', 'Contractor')->get();

    return view('App.Home.Contractors')->with([
        'contractors' => $contractors,
    ]);
});

Route::get('/Contractor', [ContractorController::class,'get_all_contractor_with_Application'])->middleware(['auth'])->name('account');

Route::resource('/contractor', ContractorController::class)->middleware(['auth']);
