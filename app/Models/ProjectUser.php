<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    use HasFactory;

    protected $table = 'project_user';

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    public function level()
    {
        return $this->belongsTo('App\Models\Level');
    }
}
