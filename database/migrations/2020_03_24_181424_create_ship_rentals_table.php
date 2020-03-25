<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipRentalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ship_rentals', function (Blueprint $table) {
            $table->bigIncrements('id')->comment("대여 번호");

            $table->unsignedBigInteger('user_id')->comment("회원 번호");
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('ship_id')->comment("배 번호");
            $table->foreign('ship_id')->references('id')->on('ships')->onDelete('cascade');
            
            $table->string('departure_date')->comment("출항날짜");
            $table->integer('number_of_people')->comment("사용자 인원");
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
        Schema::dropIfExists('ship_rentals');
    }
}
