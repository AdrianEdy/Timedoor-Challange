<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    private $imageFolder = 'image/board/';

    public function user()
    {
        return $this->belongTo('App\User');
    }

    public function getImageFolder()
    {
        return $this->imageFolder;
    }
}
