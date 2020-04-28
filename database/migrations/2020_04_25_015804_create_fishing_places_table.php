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

            $table->string('phone_number')->comment("대표자 휴대폰번호");
            // $table->foreign('phone_ number')->references('phone_number')->on('users')->onDelete('cascade');
            
            $table->string('place_name')->default('')->comment("낚시터 상호명");
            $table->string('location')->default('')->comment("사업장 주소");
            $table->string('fishing_type')->default('')->comment("낚시 업종");
            $table->string('people')->default('')->comment("수용 인원");
            $table->string('available_time')->default('')->comment("이용시간");
            $table->string('homepage')->default('')->comment("홈페이지");
            $table->string('place_photo')->default('')->comment("업장 사진");
            $table->string('main_fish_species')->default('')->comment("주요 어종");
            $table->text('main_fish_image')->comment("주요 어종 이미지");
            $table->string('price')->default('')->comment("낚시터 가격");
            
            
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
