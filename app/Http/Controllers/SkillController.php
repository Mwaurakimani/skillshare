<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Skill $skill
     * @return \Illuminate\Http\Response
     */
    public function show(Skill $skill)
    {
        return array(
            'resp' => true
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Skill $skill
     * @return \Illuminate\Http\Response
     */
    public function edit(Skill $skill)
    {
        return array(
            'resp' => true
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Skill $skill
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Skill $skill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $skill = Skill::find($request->skill_id);

        $skill->delete();

        return array(
            'resp'=> true
        );
    }

    public function getSkill(Request $request)
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

}
