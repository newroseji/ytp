<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdsTest extends TestCase
{

	use RefreshDatabase;

	/** @test */
	public function user_can_create_ad(){

		//$this->withoutExceptionHandling();

		$user = factory('App\User')->create();

		$user->ads()->create([
			'title'=>'Foo',
			'description'=>'Bar',

			'price'=>mt_rand(1000, 9999)/ 10,
			'user_id'=>1,
			'category_id'=>mt_rand(1,10),

			
			'expires'=>Carbon::now()->addDay()->format('Y-m-d H:i:s'),
			'publish'=> Carbon::now()->format('Y-m-d H:i:s'),
		]);


		$this->assertEquals('Bar',$user->ads[0]['description']);


	}
}
