<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Board extends Model
{
    protected $fillable=['description','name','board_state','id_creator','id_project'];
    protected $table='board';
    public $timestamps = false;
}