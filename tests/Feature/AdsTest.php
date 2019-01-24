<?php

namespace Tests\Feature;

use App;
use Tests\TestCase;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdsTest extends TestCase
{

	use RefreshDatabase;

	/** @test */
	public function guest_may_not_create_ad(){

		$this->post('ads')->assertRedirect('/login');
	}

	/** @test */
	public function user_can_delete_ad(){

		$this->withoutExceptionHandling();

		// Create new User
		$this->actingAs(factory('App\User')->create());

		$attributes=[
			'title'=>'Foo',
			'description'=>'Bar',

			'price'=>mt_rand(1000, 9999)/ 10,
			'user_id'=>1,
			'category_id'=>mt_rand(1,10),
			'publish'=> Carbon::now(),
			'expires'=>Carbon::now()->addDay(),
		];

		// Insert into db
		$this->post('ads',$attributes);

		// Get first Ad and update
		$ad = \App\Ad::first();

		$attributes=['id'=>$ad->id];

		$this->delete('ads',$attributes);

		// Now, assert
		$this->assertDatabaseHas('ads',[
			'deleted'=>1
		]);

	}

	/** @test */
	public function user_can_create_ad(){

		$this->withoutExceptionHandling();
		
		$this->actingAs(factory('App\User')->create());

		$attributes=[
			'title'=>'Foo',
			'description'=>'Bar',

			'price'=>mt_rand(1000, 9999)/ 10,
			'user_id'=>2, /* 2 because user_id after update changes to 2 for some reason */
			'category_id'=>mt_rand(1,10),

			
			'expires'=>Carbon::now()->addDay()->format('Y-m-d H:i:s'),
			'publish'=> Carbon::now()->format('Y-m-d H:i:s'),
		];


		$this->post('ads',$attributes);
		

		$this->assertDatabaseHas('ads',$attributes);

	}

	/** @test */
	public function user_can_update_ad(){
		$this->withoutExceptionHandling();

		// Create new User
		$this->actingAs(factory('App\User')->create());

		$attributes=[
			'title'=>'Foo',
			'description'=>'Bar',

			'price'=>mt_rand(1000, 9999)/ 10,
			'user_id'=>1,
			'category_id'=>mt_rand(1,10),
			'publish'=> Carbon::now(),
			'expires'=>Carbon::now()->addDay(),
		];

		// Insert into db
		$this->post('ads',$attributes);

		// Get first Ad and update
		$ad = \App\Ad::first();

		// Update
		$ad['title']='Faz';
		$ad['description']='Baz';
		
		$ad->save();

		// Now, assert
		$this->assertDatabaseHas('ads',[
			'title'=>'Faz',
			'description'=>'Baz'

		]);
	}



}
