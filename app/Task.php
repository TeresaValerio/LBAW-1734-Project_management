<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Task extends Model
{
    protected $fillable=['budget','deadline','description','name','progress','task_state','id_creator','id_board'];
    protected $table='task';
    public $timestamps = false;
}