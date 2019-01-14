<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
           
            $table->double('price');

            $table->integer('user_id')->unsigned();
            $table->integer('category_id')->unsigned();

            $table->boolean('deleted')->default(0);
            $table->boolean('active')->default(1);

            $table->timestamp('expires')->nullable();
            $table->timestamp('publish')->nullable();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            
            //$table->timestamps();
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
        
    }
}
