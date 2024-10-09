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
        Schema::create('systems', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('register_ip', 15)->nullable()->comment('등록자 ip');
            $table->string('register_id', 30)->nullable()->comment('등록자 아이디');
            $table->string('title', 20)->nullable()->comment('설정 제목');
            $table->text('content')->nullable()->comment('설정 내용');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('systems');
    }
};
