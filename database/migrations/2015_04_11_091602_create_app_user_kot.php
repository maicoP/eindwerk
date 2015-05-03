<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppUserKot extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('app_userkot', function(Blueprint $table)
		{
			$table->increments('id');
			$table->enum('type',array('like','dislike'));
			$table->integer('fk_app_userid')->unsigned();
			$table->foreign("fk_app_userid")
						->references("id")
						->on("app_user")
						->onUpdate("cascade")
						->onDelete("restrict");
			$table->integer('fk_kotid')->unsigned();
			$table->foreign("fk_kotid")
						->references("id")
						->on("kot")
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
		Schema::drop('app_userkot');
	}

}
