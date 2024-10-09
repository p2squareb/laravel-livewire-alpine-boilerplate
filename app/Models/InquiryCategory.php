<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * 
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string|null $category 카테고리
 * @method static Builder|InquiryCategory newModelQuery()
 * @method static Builder|InquiryCategory newQuery()
 * @method static Builder|InquiryCategory query()
 * @method static Builder|InquiryCategory whereCategory($value)
 * @method static Builder|InquiryCategory whereCreatedAt($value)
 * @method static Builder|InquiryCategory whereId($value)
 * @method static Builder|InquiryCategory whereUpdatedAt($value)
 * @mixin Eloquent
 */
class InquiryCategory extends Model
{
    protected $fillable = [
        'category',
    ];
}
