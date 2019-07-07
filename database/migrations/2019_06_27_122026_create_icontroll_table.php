<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIcontrollTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wifiuser', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('functionname');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('GroupName');
            $table->integer('qty');
            $table->string('sale');
            $table->longText('comment');
            $table->string('functiondate');
            $table->string('functionend');
            $table->string('createby');
            $table->string('updated_by');
            $table->timestamps();
        });

        Schema::create('history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('hdate');
            $table->string('doer');
            $table->string('room');
            $table->string('password');
            $table->string('checkout');
            $table->timestamp('dtCI')->nullable();
            $table->timestamp('dtCO')->nullable();
            $table->string('strGroup');
            $table->string('strVip');
            $table->string('FolioNumber');
            $table->string('strOccupancy');
            $table->string('nameGroup');
            $table->integer('status');
            $table->timestamps();
        });

        Schema::create('MacAuth', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('MacAddress');
            $table->string('Holder');
            $table->string('model');
            $table->string('Expire');
            $table->string('GroupName');
            $table->string('Create_by');
            $table->timestamps();
        });

        Schema::create('Rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Room');
            $table->string('RoomType');
            $table->string('GroupName');
            $table->string('created_by')->nullable();
            $table->string('updated_by');
            $table->timestamps();
        });

        Schema::create('WifiGroup', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('GroupName');
            $table->integer('MaxConcurrent');
            $table->integer('Upload');
            $table->integer('Download');
            $table->string('Redirect');
            $table->string('Description');
            $table->string('Status',1);
            $table->string('Type',1);
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
        Schema::dropIfExists('wifiuser');
        Schema::dropIfExists('history');
        Schema::dropIfExists('MacAuth');
        Schema::dropIfExists('Rooms');
        Schema::dropIfExists('WifiGroup');
    }
}
