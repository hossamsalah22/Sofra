<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration
{

	public function up()
	{
		Schema::create('orders', function (Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('resturant_id')->unsigned();
			$table->integer('payment_method_id')->unsigned();
			$table->enum('order_state', array('pending', 'accepted', 'rejected', 'declined', 'delivered'));
			$table->integer('client_id')->unsigned();
			$table->text('notes')->nullable();
			$table->string('address');
			$table->float('price')->default('0');
			$table->float('total_price')->default('0');
			$table->float('delivery');
			$table->float('commission')->default('0');
			$table->text('special_order')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}
