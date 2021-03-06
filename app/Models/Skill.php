<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    public function User()
    {
        return $this->belongsToMany(User::class)
            ->as('setSkill');
    }

    public function Project()
    {
        return $this->belongsToMany(Project::class)
            ->as('projectSkillLink');
    }
}
