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
            $table->string('functionname')->nullable();
            $table->string('username')->unique();
            $table->string('password')->nullable();
            $table->string('GroupName')->nullable();
            $table->integer('qty')->nullable();
            $table->string('sale')->nullable();
            $table->longText('comment')->nullable();
            $table->string('functiondate')->nullable();
            $table->string('functionend')->nullable();
            $table->string('createby')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::create('history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('hdate')->nullable();
            $table->string('doer')->nullable();
            $table->string('room')->nullable();
            $table->string('password')->nullable();
            $table->string('checkout')->nullable();
            $table->timestamp('dtCI')->useCurrent();
            $table->timestamp('dtCO')->useCurrent();
            $table->string('strGroup')->nullable();
            $table->string('strVip')->nullable();
            $table->string('FolioNumber')->nullable();
            $table->string('strOccupancy')->nullable();
            $table->string('nameGroup')->nullable();
            $table->integer('status')->default('0');
            $table->timestamps();
        });

        Schema::create('MacAuth', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('MacAddress')->nullable();
            $table->string('Holder')->nullable();
            $table->string('model')->nullable();
            $table->string('Expire')->nullable();
            $table->string('GroupName')->nullable();
            $table->string('Create_by')->nullable();
            $table->timestamps();
        });

        Schema::create('Rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Room')->nullable();
            $table->string('RoomType')->nullable();
            $table->string('GroupName')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::create('WifiGroup', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('GroupName')->nullable();
            $table->integer('MaxConcurrent')->nullable();
            $table->integer('Upload')->nullable();
            $table->integer('Download')->nullable();
            $table->string('Redirect')->nullable();
            $table->string('Description')->nullable();
            $table->string('Status',1)->nullable();
            $table->string('Type',1)->nullable();
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
