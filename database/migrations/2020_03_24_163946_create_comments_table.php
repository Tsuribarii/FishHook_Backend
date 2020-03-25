<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id')->comment("댓글 번호");
            $table->text('content')->comment("게시글 내용");

            $table->unsignedBigInteger('comment_writer_id')->comment("댓글 작성자 번호");
            $table->foreign('comment_writer_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('post_id')->comment("게시글 작성자 번호");
            $table->foreign('post_id')->references('id')->on('boards')->onDelete('cascade');

            $table->text('content')->comment("댓글 내용");
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
        Schema::dropIfExists('comments');
    }
}
