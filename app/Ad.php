<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $table = 'ads';

    protected $fillable = [
        'title','description','category','price','user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
