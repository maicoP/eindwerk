<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTalbeKot extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('kot', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('city');
			$table->string('streatname');
			$table->string('housenumber');
			$table->string('zipcode');
			$table->string('price');
			$table->string('size');
			$table->text('info');
			$table->string('email');
			$table->string('telephonenumber');
			$table->boolean('bikestands');
			$table->boolean('seperatekitchen');
			$table->boolean('seperatebathroom');
			$table->boolean('furniture');
			$table->date('begindate');
			$table->date('enddate');
			$table->integer("fk_userid")->unsigned();
			$table->foreign("fk_userid")
						->references("id")
						->on("users")
						->onUpdate("cascade")
						->onDelete("restrict");
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
		Schema::drop('kot');
	}

}
