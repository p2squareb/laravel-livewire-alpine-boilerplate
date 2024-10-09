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
        Schema::create('board_rates', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('board_id')->unsigned()->comment('boards.id');
            $table->string('table_id', 30)->comment('board.table_id');
            $table->integer('write_id')->nullable()->index()->comment('writes.id');
            $table->integer('comment_id')->nullable()->index()->comment('comments.id');
            $table->foreignId('user_id')->nullable()->index()->comment('users.id');
            $table->enum('rate', ['up', 'down'])->default('down')->comment('추천 여부');
            $table->foreignId('target_user_id')->nullable()->index()->comment('users.id');

            $table->foreign('board_id')->references('id')->on('boards')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('target_user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('board_rates');
    }
};
