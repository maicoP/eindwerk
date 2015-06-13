<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEstimateprice extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('kot', function(Blueprint $table)
		{
			$table->boolean('estimateprice');
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
			$table->dropColumn('estimateprice');
			//
		});
	}

}
