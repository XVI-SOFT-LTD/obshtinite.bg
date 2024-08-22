<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News_i18n extends Model
{
    use SoftDeletes;

    protected $table = 'news_i18n';

    protected $fillable = [
        'news_id',
        'language_id',
        'title',
        'description',
        'tags',
        'created_at',
        'updated_at',
    ];
}
