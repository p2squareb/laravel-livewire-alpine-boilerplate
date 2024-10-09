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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('message', 512)->comment('알림 내용');
            $table->bigInteger('receive_id')->unsigned()->comment('수신자 users.id');
            $table->string('receive_nickname', 20)->comment('수신자 users.nickname');
            $table->bigInteger('send_id')->unsigned()->comment('발신자 users.id');
            $table->string('send_nickname', 20)->comment('발신자 users.nickname');
            $table->string('refer_url', 256)->comment('참조 링크');
            $table->boolean('is_read')->default(0)->comment('읽음 여부');
            $table->timestamp('read_at')->nullable()->comment('읽은 시간');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
