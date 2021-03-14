<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->longText('about_us');
			$table->string('content');
			$table->string('text');
			$table->string('phone');
			$table->string('email');
			$table->float('commission');
			$table->float('maximum');
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}