<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Contact extends Model
{
    protected $fillable=['id_board','id_user'];
    protected $table='board_team';
    public $timestamps = false;
    protected $primaryKey = 'id_board';
}