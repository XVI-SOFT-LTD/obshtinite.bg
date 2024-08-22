<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StaticPage_i18n extends Model
{
    use SoftDeletes;

    protected $table = 'static_pages_i18n';

    protected $fillable = [
        'static_page_id',
        'language_id',
        'title',
        'description',
    ];

}
