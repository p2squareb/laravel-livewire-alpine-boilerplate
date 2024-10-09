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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('table_name', 255)->comment('테이블 명');
            $table->integer('target_id')->comment('테이블 ID');
            $table->string('file_full_name', 255)->comment('파일명');
            $table->double('file_size')->comment('파일 크기');
            $table->boolean('is_delete')->default(0)->comment('삭제 여부');
            $table->timestamp('deleted_at')->nullable()->comment('삭제 시간');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
