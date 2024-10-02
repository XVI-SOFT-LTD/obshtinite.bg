<?php

namespace App\Models;

use App\Models\Book;
use App\Models\Campaign;
use App\Http\Traits\I18n;
use App\Models\BookCategory;
use App\Models\Campaignable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use SoftDeletes, I18n;

    protected $table = 'categories';

    protected $fillable = [
        'created_by',
        'updated_by',
        'parent_id',
        'active',
        'views',
        'views_day',
        'views_week',
        'views_month',
        'views_year',
        'slug',
        'created_at',
        'updated_at',
    ];

    public function childs()
    {
        return $this->hasMany('App\Models\Category', 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id', 'id');
    }

    public function news()
    {
        return $this->belongsToMany(News::class, 'news_categories');
    }

    /**
     * Get the participations for the area
     *
     * @return HasMany
     */
    public function participation(): HasMany
    {
        return $this->hasMany(Participation::class);
    }

    /* custom methods */
    public static function getParentCategories()
    {
        return self::where('parent_id', 0)->where('active', 1)->orderBy('id', 'asc')->get();
    }

    /* ADMIN */
    public static function getCategoriesAdmin()
    {
        return self::with([
            'childs.i18n',
            'i18n',
        ])
            ->where('parent_id', 0)
            ->orderBy('id', 'asc')
            ->get();
    }

    public static function getAdminCategoriesForFilters()
    {
        return self::with(['childs' => function ($query) {
            $query->withCount('news');
        }])
            ->withCount('news')
            ->where('active', 1)
            ->where('parent_id', 0)
            ->orderBy('id', 'asc')
            ->get();
    }

}