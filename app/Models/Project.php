<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;


    public function getPeriodAttribute($ss)
    {
        $s = $ss%60;
        $m = floor(($ss%3600)/60);
        $h = floor(($ss%86400)/3600);
        $d = floor(($ss%2592000)/86400);
        $M = floor($ss/2592000);

        return "$M months, $d days, $h hours, $m minutes, $s seconds";
    }



    public function Skill()
    {
        return $this->belongsToMany(Skill::class)
            ->as('projectSkillLink');
    }

}
