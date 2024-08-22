<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\News;
use App\Models\Author;

class NewsAuthor extends Model
{
    protected $table = 'news_authors';

    protected $fillable = [
        'news_id',
        'author_id',
    ];

    public function news()
    {
        return $this->belongsTo(News::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function getAuthorsAssoc(int $newsId)
    {
        return $this->where('news_id', $newsId)->pluck('author_id', 'id')->toArray();
    }

}
