<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('App.client.Project.ProjectView');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
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
}
