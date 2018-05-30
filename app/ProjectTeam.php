<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class ProjectTeam extends Model
{
    protected $fillable=['id_project','id_user'];
    protected $table='project_team';
    public $timestamps = false;
    protected $primaryKey = 'id_project';
}