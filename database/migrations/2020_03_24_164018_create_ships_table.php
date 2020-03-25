<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ships', function (Blueprint $table) {
            $table->bigIncrements('id')->comment("배 번호");

            $table->unsignedBigInteger('owner_id')->comment("업자 번호");
            $table->foreign('owner_id')->references('id')->on('ship_owners')->onDelete('cascade');
            
            $table->integer('people')->comment("인원");
            $table->integer('cost')->comment("비용");

            $table->string('departure_time')->comment("출항시간");
            $table->string('arrivel_time')->comment("입항시간");

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
        Schema::dropIfExists('ships');
    }
}
