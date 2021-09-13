<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function Accounts_show()
    {
        $users = User::all();

        return view('App.Admin.Accounts.AccountsList')->with([
            'users' => $users
        ]);
    }

    public function Accounts_edit($id)
    {
        $user = User::find($id);

        return view('App.Admin.Accounts.AccountEdit')->with([
            'user' => $user
        ]);
    }

    public function Projects_show()
    {
        $projects = Project::all();

        return view('App.Admin.Project.Project')->with([
            'projects' => $projects
        ]);
    }

    public function Contractors_show()
    {
        $contractors = User::where('role','Contractor')->get();

        return view('App.Admin.contractors.Contractor')->with([
            'Contractors' => $contractors
        ]);
    }

    public function Skills_show()
    {
        return redirect('/Skills');
    }
}
