<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    use SoftDeletes;

    protected $table = "languages";

    protected $fillable = [
        'name',
        'code',
        'active',
        'created_at',
        'updated_at',
    ];

    public static function getLanguagesForAdmin()
    {
        return self::where('active', 1)->get();
    }
}
