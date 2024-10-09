<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File as FacadesFile;

/**
 * 
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string $table_name 테이블 명
 * @property int $target_id 테이블 ID
 * @property string $file_full_name 파일명
 * @property float $file_size 파일 크기
 * @property int $is_delete 삭제 여부
 * @property string|null $deleted_at 삭제 시간
 * @method static \Illuminate\Database\Eloquent\Builder|File newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File query()
 * @method static \Illuminate\Database\Eloquent\Builder|File whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereFileFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereFileSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereIsDelete($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereTableName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereTargetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class File extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'table_name',
        'target_id',
        'file_full_name',
        'file_size',
        'is_delete',
    ];
}
