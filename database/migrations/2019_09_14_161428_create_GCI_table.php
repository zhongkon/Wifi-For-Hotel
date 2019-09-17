<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGCITable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('GCI', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->dateTime('checkin')->nullable();
			$table->string('room', 10)->nullable();
			$table->string('password', 60)->nullable();
			$table->string('strGroup', 100)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('GCI');
	}

}
