<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdsPhoto extends Model
{
    protected $fillable  = ['ad_id','image','thumbnail'];
}
