<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongTo('App\User');
    }
}
