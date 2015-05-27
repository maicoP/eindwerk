<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppUserKotsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('app_user_kots', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('type');
			$table->integer('fk_kotid')->unsigned();
			$table->integer('fk_app_userid')->unsigned();
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('app_user_kots');
	}

}
