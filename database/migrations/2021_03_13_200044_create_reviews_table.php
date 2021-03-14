<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReviewsTable extends Migration {

	public function up()
	{
		Schema::create('reviews', function(Blueprint $table) {
			$table->timestamps();
			$table->increments('id');
			$table->integer('resturant_id')->unsigned();
			$table->string('content')->nullable();
			$table->enum('rate', array('1', '2', '3', '4', '5'));
			$table->integer('client_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('reviews');
	}
}