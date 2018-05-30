<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Message extends Model
{
    protected $fillable=['message','date','id_user','id_project'];
    protected $table='message';
    public $timestamps = false;
}