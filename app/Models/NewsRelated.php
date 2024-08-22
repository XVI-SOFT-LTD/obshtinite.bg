<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\News;

class NewsRelated extends Model
{
    protected $table = 'news_related';

    protected $fillable = [
        'news_id',
        'related_id',
    ];

    public function news()
    {
        return $this->belongsTo(News::class);
    }

    public function getRelatedAssoc(int $newsId)
    {
        return $this->where('news_id', $newsId)->pluck('related_id', 'id')->toArray();
    }

}
