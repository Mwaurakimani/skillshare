<?php

Route::post('/filterContractor',function (Request $request){
    $category = $request->Category;
    $location = $request->Location;

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
                    'anchor' => 'view',
                    'filter' => false
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
