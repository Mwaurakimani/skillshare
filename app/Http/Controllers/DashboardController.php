<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{

    public function Route_Dashboard()
    {

        //redirect based on role

        switch (Auth::user()->role) {
            case 'Client':
                return view('App.client.Account');
                break;
            case 'Contractor':
                return view('App.Admin.home');
                break;
            case 'Admin':
                return view('App.Admin.Account');
                break;
            default:
                return view('/');
                break;
        }
    }

    public function Route_Account()
    {
        //get user and skills
        $user = User::where('id', Auth::user()->id)
            ->with('Skill')
            ->get();

        //get skill
        $skills = $user[0]['Skill'];

        $role = $user[0]->role;

        switch ($role) {
            case 'Client':
                return view('App.client.Account');
                break;
            case 'Contractor':
                return view('App.Contractor.Account')->with([
                        'skills' => $skills
                    ]
                );
                break;
            case 'Admin':
                return view('App.Admin.Account');
                break;
            default:
                return view('/');
                break;
        }
    }
}
