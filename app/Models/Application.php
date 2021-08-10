<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    public $incrementing = true;

    protected $table = 'project_user';

    public function User()
    {
        return $this->belongsToMany(User::class,'project_user','project_id','id')
            ->as('user');
    }

    public function Project()
    {
        return $this->belongsToMany(Project::class);
    }
}
