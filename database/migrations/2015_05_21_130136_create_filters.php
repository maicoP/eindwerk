<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilters extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('filters', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('fk_app_userid')->unsigned();
			$table->foreign("fk_app_userid")
						->references("id")
						->on("app_user")
						->onUpdate("cascade")
						->onDelete("restrict");
			$table->integer('price');
			$table->integer('size');
			$table->integer('distance');
			$table->datetime('startDate');
			$table->datetime('endDate');
			$table->boolean('bikestands');
			$table->boolean('seperatekitchen');
			$table->boolean('seperatebathroom');
			$table->boolean('furniture');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('filters');
	}

}
