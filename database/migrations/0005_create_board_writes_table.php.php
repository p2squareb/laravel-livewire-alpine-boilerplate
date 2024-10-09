<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('board_writes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('board_id')->unsigned()->default(0)->comment('tbl.boards.id');
            $table->string('table_id', 30)->comment('테이블 아이디');
            $table->string('categories', 50)->nullable()->comment('카테고리');
            $table->boolean('is_notice')->default(0)->comment('공지글 여부');
            $table->boolean('is_delete')->default(0)->comment('삭제 여부');
            $table->timestamp('deleted_at')->nullable()->comment('삭제일시');
            $table->string('subject', 256)->comment('제목');
            $table->text('content')->comment('내용');
            $table->integer('hit')->unsigned()->default(0)->comment('조회수');
            $table->integer('rate_up')->unsigned()->default(0)->comment('추천 수');
            $table->integer('rate_down')->unsigned()->default(0)->comment('비추천 수');
            $table->integer('comment_count')->unsigned()->default(0)->comment('댓글 수');
            $table->foreignId('user_id')->unsigned()->nullable()->index()->comment('작성자 회원 인덱스');
            $table->string('password', 256)->nullable()->comment('비밀번호');
            $table->string('writer', 50)->nullable()->comment('작성자');
            $table->boolean('has_image')->default(false)->comment('본문에 이미지 포함 여부');
            $table->boolean('has_video')->default(false)->comment('본문에 영상 포함 여부');
            $table->string('ip', 15)->comment('작성자 아이피');
            $table->string('list_file', 256)->nullable()->comment('목록 첨부파일');

            $table->foreign('board_id')->references('id')->on('boards')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('board_writes');
    }
};
