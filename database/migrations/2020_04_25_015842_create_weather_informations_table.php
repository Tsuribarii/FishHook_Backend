<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeatherInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather_informations', function (Blueprint $table) {
            $table->bigIncrements('id')->comment("날씨 번호");
            $table->string('location')->comment("위치");
            $table->string('temperature')->comment("온도");
            $table->string('humidity')->comment("습도");
            $table->string('wind_direction')->comment("풍향");
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
        Schema::dropIfExists('weather_informations');
    }
}
