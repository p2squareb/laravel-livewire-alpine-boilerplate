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
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('categories', 50)->nullable()->comment('카테고리');
            $table->boolean('is_delete')->default(0)->comment('삭제 여부');
            $table->timestamp('deleted_at')->nullable()->comment('삭제일시');
            $table->string('subject', 256)->comment('제목');
            $table->text('content')->comment('내용');
            $table->foreignId('user_id')->nullable()->index()->unsigned()->comment('작성자 회원 인덱스');
            $table->string('writer', 50)->comment('작성자');
            $table->text('answer_content')->nullable()->comment('답변');
            $table->foreignId('answer_user_id')->unsigned()->nullable()->comment('답변자 회원 인덱스');
            $table->string('answer_writer', 50)->nullable()->comment('답변자');
            $table->timestamp('answered_at')->nullable()->comment('답변일시');
            $table->boolean('status')->unsigned()->default(0)->comment('답변상태 0:미답변, 1:답변완료');
            $table->string('ip', 15)->comment('작성자 아이피');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('answer_user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
