<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFishnameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fishname', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment("회원 번호");
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('fishname');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fishname');
    }
}
