<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Contact extends Model
{
    protected $fillable=['id_user','id_contact'];
    protected $table='contact';
    public $timestamps = false;
    protected $primaryKey = 'id_user';
}