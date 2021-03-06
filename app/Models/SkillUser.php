<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class SkillUser extends Pivot
{
    use HasFactory;

    public $incrementing = true;

    protected $table = 'skill_user';
}
