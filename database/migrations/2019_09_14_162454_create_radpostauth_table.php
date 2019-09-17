<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRadpostauthTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql2')->create('radpostauth', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('username', 64)->default('');
			$table->string('pass', 64)->default('');
			$table->string('reply', 32)->default('');
			$table->timestamp('authdate')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('mysql2')->drop('radpostauth');
	}

}
