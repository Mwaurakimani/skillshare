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
use App\Http\Controllers\SkillController;

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
    $contractors = User::where('role','=','Contractor')->with('Skill')->get();

    return view('home')->with([
        'contractors'=>$contractors
    ]);
});

Route::resource('/User', userController::class);



//Dashboard
require __DIR__ . '/Dashboard/dashboard.php';
require __DIR__ . '/Dashboard/Admin/Views/AdminMainView.php';
require __DIR__ . '/Dashboard/Contractor/Ajax/project.php';
require __DIR__ . '/Dashboard/Contractor/Views/Contractors.php';
require __DIR__ . '/Dashboard/Project/Project.php';
require __DIR__ . '/Dashboard/Skills/skill.php';
require __DIR__ . '/Dashboard/dashboard.php';



//auth routes
require __DIR__ . '/auth.php';


