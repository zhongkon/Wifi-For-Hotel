<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWifiGroupTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('WifiGroup', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('GroupName', 180)->nullable();
			$table->integer('MaxConcurrent')->nullable();
			$table->integer('Upload')->nullable();
			$table->integer('Download')->nullable();
			$table->string('Redirect', 150)->nullable();
			$table->text('Description')->nullable();
			$table->string('Status', 1)->nullable();
			$table->string('Type', 1)->nullable();
			$table->text('info')->nullable();
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
		Schema::drop('WifiGroup');
	}

}
