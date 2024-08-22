<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use SoftDeletes;

    const DIR = 'images';

    protected $table = 'images';

    protected $fillable = [
        'filename',
        'original_filename',

    ];

}
