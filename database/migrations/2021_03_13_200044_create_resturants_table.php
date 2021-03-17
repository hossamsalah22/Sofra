<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResturantsTable extends Migration {

	public function up()
	{
		Schema::create('resturants', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('image');
			$table->float('delivery');
			$table->integer('min_charge');
			$table->enum('status', array('open', 'closed'));
			$table->string('email');
			$table->string('phone');
			$table->string('password');
			$table->string('api_token', 60)->unique()->nullable();
			$table->string('pin_code')->nullable();
			$table->integer('neighbourhood_id')->unsigned();
			$table->string('whats_num');
			$table->string('resturant_phone');
		});
	}

	public function down()
	{
		Schema::drop('resturants');
	}
}