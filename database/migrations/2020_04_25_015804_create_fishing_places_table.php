<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFishingPlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fishing_places', function (Blueprint $table) {
            $table->bigIncrements('id')->comment("낚시터 번호");
            
            $table->unsignedBigInteger('user_id')->comment("대표자 번호");
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->string('place_name')->comment("낚시터 상호명");
            $table->string('location')->comment("사업장 주소");
            $table->string('fishing_type')->comment("낚시 업종");
            $table->integer('people')->comment("수용 인원");
            $table->string('available_time')->comment("이용시간");
            $table->string('homepage')->comment("홈페이지");
            $table->string('place_photo')->comment("업장 사진");
            $table->string('pay_information')->comment("결제 정보");
            $table->string('main_fish_species')->comment("주요 어종");
            $table->string('main_fish_image')->comment("주요 어종 이미지");
            
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
        Schema::dropIfExists('fishing_places');
    }
}
