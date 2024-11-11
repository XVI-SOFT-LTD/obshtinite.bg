<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'municipality_id',
        'title',
        'description',
        'logo',
        'url',
        'publish_date',
    ];

    public function getHomepageNews(int $limit)
    {
        return $this->take($limit)->latest()->get();
    }
}
