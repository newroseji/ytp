<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $table = 'ads';

    protected $fillable = [
        'title','description','category_id','price','user_id','active','publish','expires'
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

    

    


}
