<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMacAuthTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('MacAuth', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('MacAddress', 18)->nullable();
			$table->string('Holder', 190)->nullable();
			$table->string('model', 190)->nullable();
			$table->string('Expire', 40)->nullable();
			$table->string('GroupName', 190)->nullable();
			$table->string('Create_by', 190)->nullable();
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
		Schema::drop('MacAuth');
	}

}
