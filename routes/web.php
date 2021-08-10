<?php

use App\Http\Controllers\ContractorController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\userController;
use App\Models\Project;
use App\Models\ProSkill;
use App\Models\Skill;
use App\Models\SkillUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Models\Application;

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

//backend
Route::get('/dashboard', function () {
    $user = Auth::user();
    $role = $user->role;
    if ($role == 'Client') {
        return view('App.client.Account');
    } elseif ($role == 'Contractor') {
        return view('App.Contractor.home');
    } elseif ($role == 'Admin') {
        return redirect()->route('/');
    } else {
        return redirect()->route('/');
    }
})->middleware(['auth'])->name('dashboard');

Route::get('/account', function () {
    $user = User::where('id', Auth::user()->id)
        ->with('Skill')
        ->get();
    $skills = $user[0]['Skill'];


    $role = $user[0]->role;
    if ($role == 'Client') {
        return view('App.client.Account');
    } elseif ($role == 'Contractor') {
        return view('App.Contractor.Account')->with([
                'skills' => $skills
            ]
        );
    } elseif ($role == 'Admin') {
        return redirect()->route('/');
    } else {
        return redirect()->route('/');
    }
})->middleware(['auth'])->name('account');

Route::get('/Contractor', function () {
    $applications = Project::where('user_id', Auth::user()->id)->with('Application')->get();

    if(count($applications) <= 0){
        return view('App.client.contractors.Contractor')->with([
            'contractors' => null
        ]);
    }

    $contractors = $applications[0]['Application'];

    return view('App.client.contractors.Contractor')->with([
        'contractors' => $contractors
    ]);
})->middleware(['auth'])->name('account');

Route::get('/Contractor/{id}', function (User $user, $id) {

    $user = User::findOrFail($id);

    $applications = Application::where('user_id', $id)->get();

    if(count($applications) <= 0){
        return view('App.client.contractors.ContractorForm')
            ->with([
                'user' => $user,
                'projects' => null,
                'applications' => null
            ]);
    }

    $projects = [];

    foreach ($applications as $application) {
        $project = Project::findOrFail($application->project_id);

        array_push($projects, $project);
    }


    return view('App.client.contractors.ContractorForm')
        ->with([
            'user' => $user,
            'projects' => $projects,
            'applications' => $applications
        ]);
})->middleware(['auth'])->name('account');


Route::post('/Contractor/hire', function (Request $request) {
    $project_id = $request->project_id;
    $user_id = $request->user_id;


    $application = Application::where('project_id', $project_id)
        ->where('user_id', $user_id)
        ->get();
    $application = $application[0];

//
    $application->assigned = 1;
//
    $application->save();

    return array(
        'response' => true
    );
})->middleware(['auth'])->name('account');

Route::post('/Contractor/fire', function (Request $request) {
    $project_id = $request->project_id;
    $user_id = $request->user_id;


    $application = Application::where('project_id', $project_id)
        ->where('user_id', $user_id)
        ->get();
    $application = $application[0];

//
    $application->assigned = 0;
//
    $application->save();

    return array(
        'response' => true
    );
})->middleware(['auth'])->name('account');

Route::get('/contractor/project', function () {
    //get all projects associated with him/her
    $applications = Application::where('user_id',Auth::user()->id)->get();
    $projects = [];

    foreach ($applications as $application){
        $project_id = $application->project_id;

        $project = Project::find($project_id);

        array_push($projects,$project);
    }

    return view('App.Contractor.Project.Project')->with([
        'projects' => $projects
    ]);
})->middleware(['auth'])->name('account');

Route::resource('/User', userController::class);


//js ends
Route::post('/searchSkill', function (Request $request) {
    $skill = $request->skill;

    $skills = Skill::where('name', 'like', '%' . $skill . '%')->get();


    return array(
        'msg' => $skills
    );
});

Route::post('/addSkill', function (Request $request) {
    $skill = array(
        'skill_name' => $request->skill_name,
        'skill_id' => $request->skill_id,
        'project_id' => $request->project_id
    );

    //test if item exist
    $exist = DB::table('project_skill')
        ->where([
            ['project_id', $skill['project_id']],
            ['skill_id', $skill['skill_id']]
        ])->get();


    if (count($exist) == 0) {
        //create new
        $proskill = new ProSkill();

        $proskill->project_id = intval($skill['project_id']);
        $proskill->skill_id = intval($skill['skill_id']);

        $proskill->save();

        $proskill = DB::table('project_skill')
            ->where([
                ['project_id', $skill['project_id']],
                ['skill_id', $skill['skill_id']]
            ])->get();

        $skill = Skill::find($skill['skill_id']);

        return array(
            'status_code' => 1,
            'skill' => $skill
        );
    } else {
        return array(
            'status_code' => 0
        );
    }


});

Route::post('/addSkillToUser', function (Request $request) {
    $skill = array(
        'skill_name' => $request->skill_name,
        'skill_id' => $request->skill_id,
        'user_id' => $request->user_id
    );

    //test if item exist
    $exist = DB::table('skill_user')
        ->where('skill_id', $skill['skill_id'])
        ->where('user_id', $skill['user_id'])
        ->get();


    if (count($exist) == 0) {
        //create new
        $uskill = new SkillUser();

        $uskill->user_id = intval($skill['user_id']);
        $uskill->skill_id = intval($skill['skill_id']);

        $test = $uskill->save();

        $exist = DB::table('skill_user')
            ->where('skill_id', $skill['skill_id'])
            ->where('user_id', $skill['user_id'])
            ->get();

        $skill = Skill::find($skill['skill_id']);

        return array(
            'status_code' => 1,
            'skill' => $skill
        );
    } else {
        return array(
            'status_code' => 0
        );
    }


});

Route::post('/removeSkill', function (Request $request) {
    $skill = array(
        'skill_name' => $request->skill_name,
        'skill_id' => $request->skill_id,
        'project_id' => $request->project_id
    );

    //test if item exist
    $exist = DB::table('project_skill')
        ->where([
            ['project_id', $skill['project_id']],
            ['skill_id', $skill['skill_id']]
        ])->get();


    if (count($exist) > 0) {
        $pro_skill = ProSkill::find($exist[0]->id);

        $pro_skill->delete();
        return array(
            'status_code' => 1
        );
    } else {
        return array(
            'status_code' => 0,
            'exist' => $skill
        );
    }
});

Route::post('/project/complete',function (Request $request){
    $project = Project::find($request->project_id);

    $project->complete = 1;

    $project->save();

    return array(
        'data' => true
    );
});

Route::post('/project/rate',function (Request $request){
    $project_id = $request->project_id;
    $rating = $request->rating;

    $applications = Application::where('project_id',$project_id)->get();

    if(count($applications) > 0 ){
        foreach ($applications as $application){
            $application->Rating = $rating;
            $application->save();
        }
    }

    $resp = array(
        'message' => $applications
    );

    return $resp;
});

Route::post('/filterContractor',function (Request $request){
    $category = $request->Category;
    $location = $request->Location;
//    $category = 1;
//    $location = 'Nairobi';

    $query = User::where('role','Contractor');

    if($location != 'All'){
        //add location
        $users = $query->where('location',$location);
    }

    $users = $query->get();

    $all_users = $users;

    if($category !== 'All'){
        $all_users = null;
        $all_users = array();

        $entries = SkillUser::all();

        foreach ($users as $user){
            foreach ($entries as $entry){
                if($user->id == $entry->user_id && $entry->skill_id == $category){
                    array_push($all_users,$user);
                }
            }
        }
    }

    $full_view = "";

    if(count($all_users) > 0){
        foreach ($all_users as $user){
            $data = view('components.Cards.contractorCard')
                ->with([
                    'contractor' => $user,
                    'anchor' => 'view'
                ])->render();

            $full_view = $data.$full_view;
        }
    }else{
        $full_view = "<p> No Match found </p>";
    }

    return array(
        'data' => $full_view
    );
});




//home routes
require __DIR__ . '/home.php';

//tests routes
require __DIR__ . '/tester.php';

//auth routes
require __DIR__ . '/auth.php';


