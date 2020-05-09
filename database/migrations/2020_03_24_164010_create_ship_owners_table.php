<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ship_owners', function (Blueprint $table) {
            $table->bigIncrements('id')->comment("업자 번호");

            $table->unsignedBigInteger('user_id')->comment("회원 번호");
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('owner_name')->comment("사업장 이름");
            $table->string('location')->comment("사업장 주소");
            $table->string('business_time')->comment("영업 시작일");
            $table->string('homepage')->comment("홈페이지");
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
        Schema::dropIfExists('ship_owners');
    }
}
