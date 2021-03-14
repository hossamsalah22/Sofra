<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('category_resturant', function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('categories')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('category_resturant', function(Blueprint $table) {
			$table->foreign('resturant_id')->references('id')->on('resturants')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('clients', function(Blueprint $table) {
			$table->foreign('neighbourhood_id')->references('id')->on('neighbourhood')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('commissions', function(Blueprint $table) {
			$table->foreign('resturant_id')->references('id')->on('resturants')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('neighbourhood', function(Blueprint $table) {
			$table->foreign('city_id')->references('id')->on('cities')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('notifications', function(Blueprint $table) {
			$table->foreign('order_id')->references('id')->on('orders')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('offers', function(Blueprint $table) {
			$table->foreign('resturant_id')->references('id')->on('resturants')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('order_product', function(Blueprint $table) {
			$table->foreign('order_id')->references('id')->on('orders')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('order_product', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->foreign('resturant_id')->references('id')->on('resturants')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->foreign('payment_method_id')->references('id')->on('payment_methods')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->foreign('client_id')->references('id')->on('clients')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('products', function(Blueprint $table) {
			$table->foreign('resturant_id')->references('id')->on('resturants')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('resturants', function(Blueprint $table) {
			$table->foreign('neighbourhood_id')->references('id')->on('neighbourhood')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('reviews', function(Blueprint $table) {
			$table->foreign('resturant_id')->references('id')->on('resturants')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('reviews', function(Blueprint $table) {
			$table->foreign('client_id')->references('id')->on('clients')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('category_resturant', function(Blueprint $table) {
			$table->dropForeign('category_resturant_category_id_foreign');
		});
		Schema::table('category_resturant', function(Blueprint $table) {
			$table->dropForeign('category_resturant_resturant_id_foreign');
		});
		Schema::table('clients', function(Blueprint $table) {
			$table->dropForeign('clients_neighbourhood_id_foreign');
		});
		Schema::table('commissions', function(Blueprint $table) {
			$table->dropForeign('commissions_resturant_id_foreign');
		});
		Schema::table('neighbourhood', function(Blueprint $table) {
			$table->dropForeign('neighbourhood_city_id_foreign');
		});
		Schema::table('notifications', function(Blueprint $table) {
			$table->dropForeign('notifications_order_id_foreign');
		});
		Schema::table('offers', function(Blueprint $table) {
			$table->dropForeign('offers_resturant_id_foreign');
		});
		Schema::table('order_product', function(Blueprint $table) {
			$table->dropForeign('order_product_order_id_foreign');
		});
		Schema::table('order_product', function(Blueprint $table) {
			$table->dropForeign('order_product_product_id_foreign');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->dropForeign('orders_resturant_id_foreign');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->dropForeign('orders_payment_method_id_foreign');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->dropForeign('orders_client_id_foreign');
		});
		Schema::table('products', function(Blueprint $table) {
			$table->dropForeign('products_resturant_id_foreign');
		});
		Schema::table('resturants', function(Blueprint $table) {
			$table->dropForeign('resturants_neighbourhood_id_foreign');
		});
		Schema::table('reviews', function(Blueprint $table) {
			$table->dropForeign('reviews_resturant_id_foreign');
		});
		Schema::table('reviews', function(Blueprint $table) {
			$table->dropForeign('reviews_client_id_foreign');
		});
	}
}