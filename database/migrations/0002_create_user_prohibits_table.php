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
        Schema::create('user_prohibits', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('user_id')->unsigned()->comment('users.id');
            $table->tinyInteger('gubun')->unsigned()->comment('1:이용정지, 0:이용정지 해제');
            $table->string('period_type', 10)->comment('이용정지 기간');
            $table->timestamp('until_date')->comment('정지 기간 종료일');
            $table->string('cause', 512)->nullable()->comment('사유');
            $table->bigInteger('processed_by_user_id')->unsigned()->comment('처리 관리자 users.id');
            $table->string('processed_by_user_nickname', 30)->comment('처리 관리자 users.nickname');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_prohibits');
    }
};
