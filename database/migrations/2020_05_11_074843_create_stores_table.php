<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->increments('id')->comment("스토어 번호");;
            $table->string('name')->comment("스토어 이름");;
            $table->string('address')->nullable()->comment("주소");;
            $table->double('latitude')->nullable()->comment("위도");;
            $table->double('longitude')->nullable()->comment("경도");;
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
        Schema::dropIfExists('stores');
    }
}
