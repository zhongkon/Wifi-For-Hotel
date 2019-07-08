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
            $table->string('username',64)->default('');
            $table->string('attribute',64)->default('');
            $table->char('op',2)->default(':=');
            $table->string('value',253)->default('');
        });

        Schema::connection('mysql4')->create('radgroupreply', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('groupname',64)->default('');
            $table->string('attribute',64)->default('');
            $table->char('op',2)->default(':=');
            $table->string('value',253)->default('');
        });


        Schema::connection('mysql4')->create('radreply', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username',64)->unique()->default('');
            $table->string('attribute',64)->default('');
            $table->char('op',2)->default(':=');
            $table->string('value',253)->nullable();                
        });

        Schema::connection('mysql4')->create('radusergroup', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username',64)->default('');
            $table->string('groupname',64)->default('');
            $table->integer('priority')->default('1');
        });

        Schema::connection('mysql4')->create('radpostauth', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username',64)->default('');
            $table->string('pass',64)->default('');
            $table->string('reply',32)->default('');
            $table->timestamp('authdate')->useCurrent();
            $table->engine = 'InnoDB';
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
