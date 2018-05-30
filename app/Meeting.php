<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Meeting extends Model
{
    protected $fillable=['date','name','place','id_board'];
    protected $table='meeting';
    public $timestamps = false;
}