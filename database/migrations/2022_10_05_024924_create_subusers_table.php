<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subusers', function (Blueprint $table) {
            $table->id();
            $table->string('userid');
            $table->string('subuserid')->nullable();
            $table->string('img')->nullable();
            $table->string('name');
            $table->string('contract');
            $table->string('email');
            $table->string('password');
            $table->string('type');
            $table->string('createdon');
            $table->string('status')->default('Enable');

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
        Schema::dropIfExists('subusers');
    }
}
