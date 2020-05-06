<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boards', function (Blueprint $table) {
            $table->bigIncrements('id')->comment("게시글 번호");

            $table->unsignedBigInteger('user_id')->comment("작성자 번호");
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('tide')->comment("물때");
            $table->foreign('tide')->references('id')->on('tide_informations')->onDelete('cascade');

            $table->string('title')->comment("게시글 제목");
            $table->string('species')->comment("어종 이름");
            // $table->string('tide')->comment("물때");
            $table->string('bait')->comment("미끼");
            $table->string('location')->comment("위치");
            $table->text('content')->comment("게시글 내용");
            $table->integer('hits')->default(0)->comment("조회수");
            $table->integer('sympathy')->default(0)->comment("공감");
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
        Schema::dropIfExists('boards');
    }
}
