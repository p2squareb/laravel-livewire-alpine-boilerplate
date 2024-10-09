<?php

namespace Database\Seeders;

use App\Models\Board;
use App\Models\InquiryCategory;
use App\Models\System;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        UserGroup::insert([
            ['name' => '최고관리자', 'level' => 99, 'comment' => '최고관리자', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '관리자', 'level' => 11, 'comment' => '관리자', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '일반회원', 'level' => 1, 'comment' => '일반회원', 'created_at' => now(), 'updated_at' => now()],
        ]);

        User::insert([
            'name' => '운영자',
            'nickname' => '운영자',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('1234'),
            'group_level' => 99,
            'social_type' => 'email',
            'last_login_at' => now(),
            'login_ip' => fake()->ipv4(),
        ]);
        User::insert([
            'name' => '테스터',
            'nickname' => '테스터',
            'email' => 'p2squareb@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('1234'),
            'group_level' => 1,
            'social_type' => 'email',
            'last_login_at' => now(),
            'login_ip' => fake()->ipv4(),
        ]);
        User::insert([
            'name' => '홍길동',
            'nickname' => '홍길동',
            'email' => 'p2squareb@naver.com',
            'email_verified_at' => now(),
            'password' => Hash::make('1234'),
            'group_level' => 1,
            'social_type' => 'email',
            'last_login_at' => now(),
            'login_ip' => fake()->ipv4(),
        ]);

        //User::factory(100)->create();

        $configData = [
            'socialLogin' => [
                'use_sns' => '0',
                'google' => [
                    'client_id' => '',
                ],
            ],
        ];
        System::insert([
            'register_ip' => '0.0.0.0',
            'register_id' => 'system',
            'title' => 'external',
            'content' => json_encode($configData),
        ]);

        $configData = [
            'policy' => [
                'terms' => '이용약관',
                'policy' => '개인정보처리방침',
            ],
        ];
        System::insert([
            'register_ip' => request()->ip(),
            'register_id' => 'system',
            'title' => 'policy',
            'content' => json_encode($configData),
        ]);

        $configData = [
            'basic' => [
                'site_name' => 'SQUARE BOARD',
                'domain_name' => 'psquare.com',
                'sq_email' => 'p2squareb@gmail.com',
                'use_smtp' => '1',
                'use_external_email' => '0',
                'use_dormant' => '0',
            ],
            'image' => [
                'image_resize' => '1',
                'image_width_max' => '1280',
            ],
        ];
        System::insert([
            'register_ip' => request()->ip(),
            'register_id' => 'system',
            'title' => 'basic',
            'content' => json_encode($configData),
        ]);

        $configData = [
            'point' => [
                'use_point_join' => '1',
                'use_point_join_amt' => '1000',
                'use_point_login' => '1',
                'use_point_login_amt' => '10',
                'use_point_write' => '1',
                'use_point_write_amt' => '10',
                'use_point_write_comment' => '1',
                'use_point_write_comment_amt' => '5',
                'use_point_write_up' => '1',
                'use_point_write_up_amt' => '10',
                'use_point_write_down' => '1',
                'use_point_write_down_amt' => '-5',
                'use_point_comment' => '1',
                'use_point_comment_amt' => '5',
                'use_point_comment_up' => '1',
                'use_point_comment_up_amt' => '5',
                'use_point_comment_down' => '1',
                'use_point_comment_down_amt' => '-2',
            ],
        ];
        System::insert([
            'register_ip' => request()->ip(),
            'register_id' => 'system',
            'title' => 'point',
            'content' => json_encode($configData),
        ]);

        Board::insert([
            'table_id' => 'test',
            'table_name' => '임시테스트',
            'status' => 1,
            'use_category' => 0,
            'category_list' => '구글,애플,네이버,카카오,페이스북,인스타그램,트위터,유튜브',
            'write_level' => 1,
            'use_comment' => 1,
            'use_rate' => 1,
            'use_report' => 1,
            'skin' => 'basic',
        ]);

        for($i = 1; $i <= 5; $i++) {
            InquiryCategory::insert([
                'category' => '문의유형'.$i,
            ]);
        }
    }
}
