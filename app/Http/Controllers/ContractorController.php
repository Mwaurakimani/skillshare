<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;

class ContractorController extends Controller
{
    public function index()
    {
        $contractors = User::where('role','=','Contractor')->get();

        return view('App.client.contractors.Contractor');
    }

    public function get_all_contractor_with_Application()
    {
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
    }

    public function get_contractor_with_applications($id)
    {
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
    }

    public function hire_contractor(Request $request)
    {
        $project_id = $request->project_id;
        $user_id = $request->user_id;


        $application = Application::where('project_id', $project_id)
            ->where('user_id', $user_id)
            ->get();
        $application = $application[0];

        $application->assigned = 1;

        $application->save();

        return array(
            'response' => true
        );
    }

    public function fire_contractor(Request $request)
    {
        $project_id = $request->project_id;
        $user_id = $request->user_id;


        $application = Application::where('project_id', $project_id)
            ->where('user_id', $user_id)
            ->get();
        $application = $application[0];

        $application->assigned = 0;

        $application->save();

        return array(
            'response' => true
        );
    }

    public function get_projects_applied_for()
    {
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
    }

    public function apply_for_job(Request $re)
    {
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
    }
}
