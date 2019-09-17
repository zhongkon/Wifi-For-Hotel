<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('history', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->dateTime('hdate')->nullable();
			$table->string('doer', 100)->nullable();
			$table->string('room', 10)->nullable();
			$table->string('password', 60)->nullable();
			$table->string('checkout', 60)->nullable();
			$table->dateTime('dtCI')->nullable();
			$table->dateTime('dtCO')->nullable();
			$table->string('strGroup', 100)->nullable();
			$table->string('strVip', 100)->nullable();
			$table->string('FolioNumber', 50)->nullable();
			$table->string('strOccupancy', 50)->nullable();
			$table->string('nameGroup', 150)->nullable();
			$table->string('GuestFname', 150)->nullable();
			$table->string('GuestName', 170)->nullable();
			$table->string('Lang', 3)->nullable();
			$table->char('GuestShare', 1)->nullable();
			$table->string('Workstation', 30)->nullable();
			$table->string('QrcodeFilename', 160)->nullable();
			$table->string('ReservationNumber', 30)->nullable();
			$table->string('ProfileNumber', 30)->nullable();
			$table->char('Reprint', 1)->nullable();
			$table->integer('status')->nullable()->default(0);
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
		Schema::drop('history');
	}

}
