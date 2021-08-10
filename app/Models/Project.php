<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function getPeriodAttribute($time)
    {
        $value = array(
            "years" => 0, "months" => 0, "days" => 0, "hours" => 0,
            "minutes" => 0, "seconds" => 0,
        );
        if ($time >= 31556926) {
            $value["years"] = floor($time / 31556926);
            $time = ($time % 31556926);
        }
        if ($time >= 2592000) {
            $value["months"] = floor($time / 2592000);
            $time = ($time % 2592000);
        }
        if ($time >= 86400) {
            $value["days"] = floor($time / 86400);
            $time = ($time % 86400);
        }
        if ($time >= 3600) {
            $value["hours"] = floor($time / 3600);
            $time = ($time % 3600);
        }
        if ($time >= 60) {
            $value["minutes"] = floor($time / 60);
            $time = ($time % 60);
        }
        $value["seconds"] = floor($time);

        return $value;

    }

    public function getPeriodStringAttribute(){
        $period = $this->period;

        $period_string = "";


        foreach ($period as $key => $time) {

            if ($time > 0 && $key == "years") {
                if ($time > 1) {
                    $period_string = $period_string . " " . $time . " Years ";
                }else{
                    $period_string = $period_string . " " . $time . " Year ";
                }
            } elseif ($time > 0 && $key == "months") {
                if ($time > 1) {
                    $period_string = $period_string . " " . $time . " months ";
                }else{
                    $period_string = $period_string . " " . $time . " month ";
                }
            } elseif ($time > 0 && $key == "days") {
                if ($time > 1) {
                    $period_string = $period_string . " " . $time . " days ";
                }else{
                    $period_string = $period_string . " " . $time . " day ";
                }
            } elseif ($time > 0 && $key == "hours") {
                if ($time > 1) {
                    $period_string = $period_string . " " . $time . " hours ";
                }else{
                    $period_string = $period_string . " " . $time . " hour ";
                }
            } else {
                $period_string = $period_string . "";
            }
        }

        return $period_string;
    }

    public function Skill()
    {
        return $this->belongsToMany(Skill::class)
            ->as('projectSkillLink');
    }

    public function Owner()
    {
        return $this->belongsToMany(User::class,'projects','id','user_id')
            ->as('projectSkillLink');
    }

    public function Application()
    {
        return $this->belongsToMany(User::class)
            ->as('projectSkillLink');
    }

}
