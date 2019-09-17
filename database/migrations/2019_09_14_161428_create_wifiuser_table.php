<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWifiuserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wifiuser', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('functionname', 180)->nullable();
			$table->string('username', 15)->nullable()->unique('username');
			$table->string('password', 30)->nullable();
			$table->string('GroupName', 100)->nullable();
			$table->integer('qty')->nullable();
			$table->string('sale', 180)->nullable();
			$table->text('comment')->nullable();
			$table->string('functiondate', 30)->nullable();
			$table->string('functionend', 30)->nullable();
			$table->string('createby', 100)->nullable();
			$table->string('updated_by', 100)->nullable();
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
		Schema::drop('wifiuser');
	}

}
