<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ProSkill;
use App\Models\SkillUser;

class SkillController extends Controller
{
    //list skills
    public function list_skills()
    {
        $skills = Skill::all();

        return view('App.Contractor.Skill.index')->with([
            'skills' => $skills
        ]);
    }

    //Add Skill
    public function store(Request $request)
    {
        $skill_name = $request->skill_name;
        $skill_description = $request->skill_description;

        $skill = new Skill();

        $skill->name = $skill_name;
        $skill->description = $skill_description;

        $saved = $skill->save();

        if ($saved) {
            return array(
                'resp' => true
            );
        }
    }

    //update Skill
    public function update(Request $request)
    {
        $skill = Skill::find($request->skill_id);



        $skill->name = $request->skill_name;
        $skill->description = $request->skill_description;

        $skill->save();

        return array(
            'resp' => true
        );
    }

    //delete Skill
    public function destroy(Request $request)
    {
        $skill = Skill::find($request->skill_id);

        $skill->delete();

        return array(
            'resp'=> true
        );
    }

    //get the skill and render the fore for the skill
    public function get_Skill(Request $request)
    {
        $data = null;
        if (!isset($request->id)) {
            $data = view('components.Forms.skill-form')
                ->render();
        }
        $id = $request->skill_id;

        $skill = Skill::find($id);

        $data = view('components.Forms.skill-form')
            ->with([
                'skill' => $skill,
            ])->render();

        return array(
            'resp' => $data
        );
    }

    //ajax search for Skill
    public function search_skill(Request $request){
        $skill = $request->skill;

        $skills = Skill::where('name', 'like', '%' . $skill . '%')->get();


        return array(
            'msg' => $skills
        );
    }

    //add skill to project
    public function add_skill_to_project(Request $request)
    {
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
        }else{
            return array(
                'status_code' => 0
            );
        }
    }

    //add skill to user
    public function add_skill_user(Request $request)
    {
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
    }

    //remove skill form Project
    public function remove_skill_from_project(Request $request)
    {
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
    }
}
