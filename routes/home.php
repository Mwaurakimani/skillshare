<?php

use App\Models\User;
use App\Models\Project;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContractorController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Application;


Route::get('/', function () {
    $contractors = User::where('role','=','Contractor')->with('Skill')->get();

    return view('home')->with([
        'contractors'=>$contractors
    ]);
});

//Contractors
Route::get('/Contractors', function () {
    $contractors = User::where('role', 'Contractor')->get();

    return view('App.Home.Contractors')->with([
        'contractors' => $contractors,
    ]);
});
Route::resource('/contractor', ContractorController::class)->middleware(['auth']);

Route::resource('/Skill', \App\Http\Controllers\SkillController::class)->middleware(['auth']);



//Projects
Route::get('/Projects', function () {
    $projects = Project::all();

    return view('App.Home.Project.Project')->with([
        'projects' => $projects,
    ]);
});
Route::resource('project',ProjectController::class)->middleware(['auth']);


//Projects/id
Route::get('/Projects/{id}', function ($id) {
    $project = Project::where('id', $id)->with('Skill')->get();
    $skills = $project[0]['Skill'];
    $application = Application::where('user_id',Auth::user()->id)
        ->where('project_id',$id)
        ->get();

    return view('App.Home.Project.ProjectView')->with([
        'project' => $project[0],
        'skills' => $skills,
        'Application' => $application
    ]);
})->middleware(['auth']);

//apply for job
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



