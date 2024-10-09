<?php

namespace App\Traits;

use App\Models\Board;
use App\Models\BoardWrite;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait BoardConfig
{
    public function getBoard($tableId): Model|Builder|Board
    {
        return Board::where('table_id', $tableId)->firstOrFail();
    }

    public function updateArticleCount($tableId, $type): void
    {
        if ($type === 'create') {
            Board::where('table_id', $tableId)->increment('article_count');
        }else if ($type === 'delete') {
            Board::where('table_id', $tableId)->decrement('article_count');
        }
    }

    public function updateCommentCount($tableId, $writeId, $type): void
    {
        if ($type === 'create') {
            Board::where('table_id', $tableId)->increment('comment_count');
            BoardWrite::where('id', $writeId)->increment('comment_count');
        }else if ($type === 'delete') {
            Board::where('table_id', $tableId)->decrement('comment_count');
            BoardWrite::where('id', $writeId)->decrement('comment_count');
        }
    }
}
