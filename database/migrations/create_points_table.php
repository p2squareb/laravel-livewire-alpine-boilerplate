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
        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->enum('point_type', ['P', 'M'])->default('P')->comment('P:플러스, M:마이너스');
            $table->string('point_item', 50)->comment('지급/차감 명목');
            $table->bigInteger('to_user_id')->unsigned()->comment('포인트 받는 회원의 users.id');
            $table->bigInteger('from_user_id')->unsigned()->comment('포인트 지급/차감 발생시킨 회원의 users.id');
            $table->string('reason', 500)->comment('사유');
            $table->integer('amount')->comment('포인트');
            $table->string('target_table_name', 30)->comment('target table name');
            $table->integer('target_id')->nullable()->comment('target id');
            $table->string('processed_by', 30)->comment('처리자');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('points');
    }
};
