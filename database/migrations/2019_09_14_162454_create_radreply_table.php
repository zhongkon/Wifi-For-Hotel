<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRadreplyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql2')->create('radreply', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('username', 64)->default('')->index('username');
			$table->string('attribute', 64)->default('');
			$table->char('op', 2)->default(':=');
			$table->string('value', 253)->default('');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('mysql2')->drop('radreply');
	}

}
