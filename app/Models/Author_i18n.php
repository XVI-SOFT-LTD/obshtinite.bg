<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author_i18n extends Model
{
    use SoftDeletes;

    protected $table = 'authors_i18n';

    protected $fillable = [
        'author_id',
        'language_id',
        'fullname',
        'description',
    ];

    public function author()
    {
        return $this->belongsTo('App\Models\Author');
    }
}
