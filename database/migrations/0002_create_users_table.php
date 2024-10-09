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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->rememberToken();
            $table->timestamps();
            $table->tinyInteger('status')->unsigned()->default(1)->comment('1:정상, 2:탈퇴, 3:정지, 4:휴면');
            $table->string('name', 30)->nullable()->comment('이름');
            $table->string('nickname', 30)->unique()->comment('닉네임');
            $table->string('email', 255)->unique()->comment('이메일');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255)->nullable()->comment('비밀번호');
            $table->tinyInteger('group_level')->unsigned()->default(1)->comment('그룹 레벨');
            $table->string('cellphone', 20)->nullable()->comment('휴대폰 번호');
            $table->integer('point')->default(0)->comment('포인트');
            $table->string('zipcode', 10)->nullable()->comment('우편번호');
            $table->string('addr1', 255)->nullable()->comment('주소');
            $table->string('addr2', 255)->nullable()->comment('상세 주소');
            $table->string('social_type', 10)->nullable()->comment('SNS 로그인');
            $table->timestamp('last_login_at')->nullable()->comment('최근 로그인 시간');
            $table->string('login_ip', 20)->nullable()->comment('로그인 아이피');
            $table->timestamp('leaved_at')->nullable()->comment('탈퇴 날짜');
            $table->enum('mailing_yn', ['Y', 'N'])->default('N')->comment('메일 수신 여부');
            $table->enum('sms_yn', ['Y', 'N'])->default('N')->comment('SMS 수신 여부');
            $table->string('profile_photo_path', 255)->nullable()->comment('프로필 이미지');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
