<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReprintQueueTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ReprintQueue', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('username')->nullable();
			$table->string('password')->nullable();
			$table->string('qrcode')->nullable();
			$table->string('Lang', 4)->nullable();
			$table->string('printer')->nullable();
			$table->char('status', 1)->nullable();
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
		Schema::drop('ReprintQueue');
	}

}
