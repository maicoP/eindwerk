<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterKot extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('kot', function(Blueprint $table)
		{
			$table->string('lat');
			$table->string('lng');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('kot', function(Blueprint $table)
		{
			$table->dropcolumn('lat');
			$table->dropcolumn('lng');
		});
	}

}
