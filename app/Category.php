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

	public function scopeErased($query){
		return $query->where('deleted', 1);

	}

	public function scopeNotErased($query){
		return $query->where('deleted', 0);

	}

}
