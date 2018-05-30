<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Project extends Model
{
    protected $fillable=['name','description','start_date','end_date','privacy','id_coordinator'];
    public $timestamps = false;
}