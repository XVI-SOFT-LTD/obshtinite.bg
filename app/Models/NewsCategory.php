<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\News;
use App\Models\Category;

class NewsCategory extends Model
{
    protected $table = 'news_categories';

    protected $fillable = [
        'news_id',
        'category_id',
    ];

    public function news()
    {
        return $this->belongsTo(News::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getCatsAssoc(int $newsId)
    {
        return $this->where('news_id', $newsId)->pluck('category_id', 'id')->toArray();
    }
}
