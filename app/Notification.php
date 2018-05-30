<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Notification extends Model
{
    protected $fillable=['id','id_user','date','notification','read'];
    protected $table='notification';
    public $timestamps = false;
}