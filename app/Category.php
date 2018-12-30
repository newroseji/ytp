<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=['name','description'];
    protected $table="categories";

    public function ads(){

        return $this->hasMany('App\Ad');
    }



}
