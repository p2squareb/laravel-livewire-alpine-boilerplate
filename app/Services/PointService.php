<?php

namespace App\Services;

use App\Models\Point;
use App\Models\User;

class PointService
{
    public function savePoint(string $target_table_name, int $target_id, string $point_item, int $to_user_id, int $from_user_id): void
    {
        $point_type = ''; $reason = ''; $amount = 0; $processed_by = '';

        if ($point_item === 'join') {
            $point_type = 'P';
            $reason = '회원가입';
            $amount = cache('config.point')->point->use_point_join_amt;
            $processed_by = 'system';
        } elseif ($point_item === 'login') {
            $point_type = 'P';
            $reason = '로그인';
            $amount = cache('config.point')->point->use_point_login_amt;
            $processed_by = 'system';
        } elseif ($point_item === 'write') {
            $point_type = 'P';
            $reason = '게시글 작성에 따른 포인트 지급';
            $amount = cache('config.point')->point->use_point_write_amt;
            $processed_by = 'system';
        } elseif ($point_item === 'write_comment') {
            $point_type = 'P';
            $reason = '본인 작성글에 댓글 달림 포인트 지급';
            $amount = cache('config.point')->point->use_point_write_comment_amt;
            $processed_by = 'system';
        } elseif ($point_item === 'write_up') {
            $point_type = 'P';
            $reason = '본인 작성글에 추천 포인트 지급';
            $amount = cache('config.point')->point->use_point_write_up_amt;
            $processed_by = 'system';
        } elseif ($point_item === 'write_down') {
            $point_type = 'M';
            $reason = '본인 작성글에 비추천 포인트 차감';
            $amount = cache('config.point')->point->use_point_write_down_amt;
            $processed_by = 'system';
        } elseif ($point_item === 'comment') {
            $point_type = 'P';
            $reason = '댓글 작성에 따른 포인트 지급';
            $amount = cache('config.point')->point->use_point_comment_amt;
            $processed_by = 'system';
        } elseif ($point_item === 'comment_up') {
            $point_type = 'P';
            $reason = '본인 댓글에 추천 포인트 지급';
            $amount = cache('config.point')->point->use_point_comment_up_amt;
            $processed_by = 'system';
        } elseif ($point_item === 'comment_down') {
            $point_type = 'M';
            $reason = '본인 댓글에 비추천 포인트 차감';
            $amount = cache('config.point')->point->use_point_comment_down_amt;
            $processed_by = 'system';
        }

        $insertData = [
            'point_type' => $point_type,
            'point_item' => $point_item,
            'to_user_id' => $to_user_id,
            'from_user_id' => $from_user_id,
            'reason' => $reason,
            'amount' => $amount,
            'target_table_name' => $target_table_name,
            'target_id' => $target_id,
            'processed_by' => $processed_by,
        ];
        Point::create($insertData);

        $user = User::select('point')->where('id', $to_user_id)->first();
        $newPoints = $user->point + $amount;
        if ($newPoints < 0) {
            User::where('id', $to_user_id)->update(['point' => 0]);
        } else {
            User::where('id', $to_user_id)->increment('point', $amount);
        }
    }

    public function savePointByAdmin($point_type, $to_user_id, $from_user_id, $reason, $amount): void
    {
        $point_item = 'admin';
        $target_table_name = 'points';
        $target_id = null;
        $processed_by = 'admin';

        $insertData = [
            'point_type' => $point_type,
            'point_item' => $point_item,
            'to_user_id' => $to_user_id,
            'from_user_id' => $from_user_id,
            'reason' => $reason,
            'amount' => $amount,
            'target_table_name' => $target_table_name,
            'target_id' => $target_id,
            'processed_by' => $processed_by,
        ];
        Point::create($insertData);

        $user = User::select('point')->where('id', $to_user_id)->first();
        $newPoints = $user->point + $amount;
        if ($newPoints < 0) {
            User::where('id', $to_user_id)->update(['point' => 0]);
        } else {
            User::where('id', $to_user_id)->increment('point', $amount);
        }
    }
}
