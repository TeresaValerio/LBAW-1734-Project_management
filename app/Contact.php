<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Contact extends Model
{
    protected $fillable=['id_user','id_contact'];

}