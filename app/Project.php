<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Authenticatable as Authenticatable;

class Project extends Authenticatable
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'start_date', 'end_date'
    ];

    /**
     * The cards this user owns.
     */
     public function cards() {
      return $this->hasMany('App\Card');
    }
}
