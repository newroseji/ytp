<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advisit extends Model
{
    protected $fillable =['user_id','ad_id'];

    public function ad(){
    	return $this->belongsTo('App\Ad');
    }

    public function user($u_id=null){



    	return $u_id ? (User::find($u_id)->firstname . ' ' . User::find($u_id)->lastname) : '';
    }
}
