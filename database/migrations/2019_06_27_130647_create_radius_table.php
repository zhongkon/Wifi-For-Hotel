<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRadiusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql4')->create('radcheck', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username',64);
            $table->string('attribute',64);
            $table->char('op',2)->default(':=');
            $table->string('value',253);            
        });

        Schema::connection('mysql4')->create('radgroupreply', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('groupname',64);
            $table->string('attribute',64);
            $table->char('op',2)->default(':=');
            $table->string('value',253);                 
        });


        Schema::connection('mysql4')->create('radreply', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username',64);
            $table->string('attribute',64);
            $table->char('op',2)->default(':=');
            $table->string('value',253);                
        });

        Schema::connection('mysql4')->create('radusergroup', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username',64);
            $table->string('groupname',64);
            $table->integer('priority');     
        });

        Schema::connection('mysql4')->create('radpostauth', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username',64);
            $table->string('pass',64);
            $table->string('reply',32);
            $table->timestamp('authdate')->nullable();     
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql4')->dropIfExists('radcheck');
        Schema::connection('mysql4')->dropIfExists('radgroupreply');
        Schema::connection('mysql4')->dropIfExists('radreply');
        Schema::connection('mysql4')->dropIfExists('radusergroup');
        Schema::connection('mysql4')->dropIfExists('radpostauth');
    }
}
