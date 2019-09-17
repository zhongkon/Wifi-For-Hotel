<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRoomsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Rooms', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('Room', 10)->nullable();
			$table->string('RoomType', 100)->nullable();
			$table->string('GroupName', 100)->nullable();
			$table->string('created_by', 100)->nullable();
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
		Schema::drop('Rooms');
	}

}
