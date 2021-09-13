<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('user_id',Auth::user()->id)->get();

        if(count($projects) > 0){
            return view('App.client.Project.Project')->with([
                'projects' => $projects
            ]);
        }else{
            return view('App.client.Project.Project');
        }


    }

    public function create()
    {
        return view('App.client.Project.ProjectView');
    }

    public function store(Request $request)
    {
        request()->validate([
            'project_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $project = new Project();
        $project->title = $request->title;
        $project->complexity = $request->Complexity;
        $period = array(
            'years' => $request->period_years,
            'months' => $request->period_months,
            'days' => $request->period_days,
            'hours' => $request->period_hours,
        );
        $project->period = $this->period_setter($period);
        $project->price = $request->price;
        $project->Description = $request->Description;
        $project->user_id = Auth::user()->id;

        if ($request->project_image) {
            $this->remove_image($project->image);
            $project->image = $this->upload_image($request->project_image);
        }

        $project->save();

        $request->session()->flash('message', 'Project Was created Successfully');

        return redirect('/project/' . $project->id);
    }

    public function show($id)
    {
        $project = Project::where('id', $id)->with('Skill')->get();

        $project = $project[0];

        $skills = $project->skill;

        return view('App.client.Project.ProjectView')->with([
            'project' => $project,
            'skills' => $skills
        ]);
    }

    public function update(Request $request, Project $project)
    {
        request()->validate([
            'project_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $project->title = $request->title;
        $project->complexity = $request->Complexity;
        $period = array(
            'years' => $request->period_years,
            'months' => $request->period_months,
            'days' => $request->period_days,
            'hours' => $request->period_hours,
        );
        $project->period = $this->period_setter($period);
        $project->price = $request->price;
        $project->Description = $request->Description;

        if ($request->project_image) {
            $this->remove_image($project->image);
            $project->image = $this->upload_image($request->project_image);
        }
        $project->save();

        $request->session()->flash('message', 'User Was Updated Successfully');

        return redirect('/project/' . $project->id);
    }

    public function destroy(Project $project)
    {
        $applications = Application::where('project_id',$project->id)->get();

        foreach ($applications as $application){
            $application->delete();
        }
        return $project->delete();
    }

    public function period_setter(array $period)
    {
        $year = $period['years'] * 31556926;
        $months = $period['months'] * 2592000;
        $days = $period['days'] * 86400;
        $hours = $period['hours'] * 3600;

        $period = $year + $months + $days + $hours;

        return $period;
    }

    public function upload_image($image)
    {
        $destinationPath = public_path('/storage/ProjectImages/');

        $projectImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $image->move($destinationPath, $projectImage);

        return ($projectImage);
    }

    public function remove_image($image)
    {
        Storage::disk('local')->delete('/public/ProjectImages/'.$image);
    }

    public function set_project_as_complete(Request $request)
    {
        $project = Project::find($request->project_id);

        $project->complete = 1;

        $project->save();

        return array(
            'data' => true
        );
    }

    public function rate_project(Request $request)
    {
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
    }

    public function get_project_by_id($id ,Request $request)
    {
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
    }

    public function get_all_projects(){
        $projects = Project::all();

        return view('App.Home.Project.Project')->with([
            'projects' => $projects,
        ]);
    }

    public function searchProject(Request $request){
        $txt = $request->txt;

        $projects = Project::where("title",'LIKE', "%{$txt}%")->get();

        $view = view('components.Forms.skill-form')
            ->render();

        return $view;
    }
}
