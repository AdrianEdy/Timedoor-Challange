<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\EmailNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token', 'password'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function boards()
    {
        return $this->hasMany('App\Board');
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new EmailNotification);
    }

    public function isAdmin()
    {
        if (Auth::check() && Auth::user()->status === 'admin') {
            return true;
        }
        
        return false;
    }
}
