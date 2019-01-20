<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $table = 'ads';

    protected $fillable = [
        'title','description','category_id','price','user_id','publish','expires'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function getExpiresAttribute($value)
    {
        $date = Carbon::parse($value);
        return $date->format('m/d/Y h:i A');
    }

    public function getPublishAttribute($value)
    {
        $date = Carbon::parse($value);
        return $date->format('m/d/Y h:i A');
    }

    public function scopeErased($query,$user_id=null){
        if($user_id==null){
            return $query->where('deleted', 1);
        }
        else{
            return $query->where('deleted', 1)->where('user_id',$user_id);
        }
    }

    public function scopeNotErased($query,$user_id=null){

        if($user_id==null){
            
            return $query->where('deleted', 0);
        }
        else{
            return $query->where('deleted', 0)->where('user_id',$user_id);
        }
    }

    public function scopeExpired($query,$ad_id=null,$user_id=null){
        
     

        if($user_id!=null){
            \Log::info('reading this 1');
            
            return $query
            ->where('expires','<',now())
            ->where('user_id',$user_id);
        }
        elseif($ad_id!=null){
            \Log::info('reading this 2');
            return $query
            ->where('expires','<',now())
            ->where('id',$ad_id);
        }
        else{
            \Log::info('reading this 3');
            return $query
            ->where('expires','<',now());
        }
        

    }


}
