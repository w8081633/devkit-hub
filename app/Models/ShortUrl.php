<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{
    use HasFactory;

    /**
     * 允许批量赋值的属性
     * 
     * Laravel 为了安全默认会阻止盲目的数据写入（批量赋值保护）。
     * 我们必须在这里明确告诉 Laravel：code, original_url 和 clicks 是安全且允许写入数据库的。
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'original_url',
        'clicks',
    ];
}