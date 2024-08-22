<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category_i18n extends Model
{
    use SoftDeletes;

    protected $table = "categories_i18n";

    protected $fillable = [
        'category_id',
        'language_id',
        'name',
        'description',
        'created_at',
        'updated_at',
    ];
}
