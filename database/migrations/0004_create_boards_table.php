<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('boards', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('table_id', 30)->unique()->comment('테이블 아이디');
            $table->string('table_name', 30)->comment('테이블 이름');
            $table->boolean('status')->default(1)->comment('테이블 사용 여부');
            $table->boolean('use_category')->default(0)->comment('카테고리 사용 여부');
            $table->text('category_list')->nullable()->comment('카테고리 항목 (ex:k-pop,pop,hiphop)');
            $table->tinyInteger('write_level')->default(1)->nullable()->comment('글쓰기 등급');
            $table->boolean('use_comment')->default(1)->comment('댓글 사용 여부');
            $table->boolean('use_rate')->default(1)->comment('추천 사용 여부');
            $table->boolean('use_report')->default(1)->comment('신고 사용 여부');
            $table->string('skin', 30)->nullable()->comment('스킨');
            $table->integer('article_count')->default(0)->nullable()->comment('게시글 수');
            $table->integer('comment_count')->default(0)->nullable()->comment('댓글 수');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boards');
    }
};
