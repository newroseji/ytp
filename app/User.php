<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname','middlename','lastname','phone','mobile','street','area','city', 'email', 'password','deleted'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function ads()
    {
        return $this->hasMany('App\Ad');
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        $date = Carbon::parse($value);
        return $date->format('m/d/Y h:i A');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y h:i A');       
    }

    public function scopeErased($query){
        return $query->where('deleted', 1);
     }

    public function scopeNotErased($query){
        return $query->where('deleted', 0);
    }
    

}
