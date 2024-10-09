<?php

namespace App\Exports;

use AllowDynamicProperties;
use App\Models\Point;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

#[AllowDynamicProperties] class PointsExport implements FromQuery, WithHeadings, WithTitle, WithMapping
{
    use Exportable;

    public function __construct($pointType=null, $pagePeriod=null)
    {
        $this->pointType = $pointType;
        $this->pagePeriod = $pagePeriod;
    }

    public function query(): Point|Builder|\Illuminate\Database\Query\Builder
    {
        $query = Point::selectRaw(
            'users.nickname as to_nickname, users.email as to_email,
            point_item, point_type, amount, points.created_at, reason,
            from_users.nickname as from_nickname, from_users.email as from_email,
            processed_by'
        )->leftJoin('users', 'points.to_user_id', '=', 'users.id')->leftJoin('users as from_users', 'points.from_user_id', '=', 'from_users.id');

        if (!empty($this->pointType)) {
            $query->where('point_type', $this->pointType);
        }

        if (!empty($this->pagePeriod)) {
            if ($this->pagePeriod === '7' || $this->pagePeriod === '30') {
                $query->where('points.created_at', '>=', Carbon::now()->subDays($this->pagePeriod));
            }else if ($this->pagePeriod === '3m') {
                $query->where('points.created_at', '>=', Carbon::now()->subMonths(3));
            }else if ($this->pagePeriod === '6m') {
                $query->where('points.created_at', '>=', Carbon::now()->subMonths(6));
            }else if ($this->pagePeriod === '1y') {
                $query->where('points.created_at', '>=', Carbon::now()->subYear());
            }
        }

        return $query->orderBy('points.id', 'desc');
    }

    public function headings(): array
    {
        return [
            '회원 닉네임',
            '회원 이메일',
            '구분',
            '지급/차감',
            '금액',
            '지급/차감일',
            '사유',
            '주체 닉네임',
            '주체 이메일',
            '등록자'
        ];
    }

    public function map($point): array
    {
        $point->point_type = $point->point_type === 'P' ? '지급' : '차감';

        $point_items = [
            'join' => '회원가입',
            'login' => '로그인',
            'write' => '게시글 작성',
            'write_comment' => '댓글 추가',
            'write_up' => '게시글 추천',
            'write_down' => '게시글 비추천',
            'comment' => '댓글 작성',
            'comment_up' => '댓글 추천',
            'comment_down' => '댓글 비추천',
            'admin' => '관리자 지급/차감'
        ];

        $point->point_item = $point_items[$point->point_item] ?? $point->point_item;

        return [
            $point->to_nickname,
            $point->to_email,
            $point->point_item,
            $point->point_type,
            $point->amount,
            $point->created_at,
            $point->reason,
            $point->from_nickname ?? '',
            $point->from_email ?? '',
            $point->processed_by
        ];
    }

    public function title(): string
    {
        return '포인트 내역';
    }
}
