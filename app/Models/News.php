<?php

namespace App\Models;

use App\Models\File;
use App\Models\Author;
use App\Helpers\Helper;
use App\Models\Campaign;
use App\Models\Category;
use App\Http\Traits\I18n;
use App\Models\BookRating;
use App\Models\Campaignable;
use App\Models\Municipality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    use SoftDeletes, I18n;

    const DIR = 'news';
    const DIR_GALLERY = 'gallery';

    // cover sizes
    const MAIN_SIZE = 386 . '_';
    const SIZES = [
        [960 => 480],
        [773 => 564],
        [386 => 282],
        [320 => 368],
        [69 => 69],
    ];

    const SIZES_GALLERY = [
        [445 => 621],
        [125 => 175],
    ];

    protected $fillable = [
        'created_by',
        'updated_by',
        'slug',
        'logo',
        'publish_date',
        'website',
        'top',
        'active',
        'municipality_id',
        'popular_posts',
        'views',
        'views_day',
        'views_week',
        'views_month',
        'views_year',
        'created_at',
        'updated_at',
    ];

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'news_authors', 'news_id', 'author_id')->with('i18n');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'news_categories', 'news_id', 'category_id');
    }

    public function gallery()
    {
        return $this->hasMany(NewsGallery::class);
    }

    public function files()
    {
        return $this->morphMany(File::class, 'object', 'object_eloquent');
    }

    public function related()
    {
        return $this->belongsToMany(News::class, 'news_related', 'news_id', 'related_id');
    }

    /**
     * Get the municipality that owns the news.
     *
     * @return BelongsTo
     */
    public function municipality(): BelongsTo
    {
        return $this->belongsTo(Municipality::class, 'id');
    }

    public function previous()
    {
        return self::where('id', '<', $this->id)
            ->where('active', 1)
            ->where('publish_date', '<=', date('Y-m-d H:i'))
            ->orderBy('id', 'desc')
            ->first();
    }

    public function next()
    {
        return self::where('id', '>', $this->id)
            ->where('active', 1)
            ->where('publish_date', '<=', date('Y-m-d H:i'))
            ->orderBy('id', 'asc')
            ->first();
    }

    public function getDir()
    {
        return AdminController::MAIN_DIR . self::DIR . '/' . intval($this->id / 1000) . '/';
    }

    public function getLogo(int $size = 0)
    {
        if (!$size) {
            $size = self::MAIN_SIZE;
        } else {
            $size = $size . '_';
        }

        return Helper::getLogo($this->logo, $this->getDir(), $size);
    }

    public function getUrl()
    {
        return route('news.show', ['slug' => $this->slug, 'id' => $this->id]);
    }

    public function getTopNewsHomepage(int $limit = 3)
    {
        return $this->where('active', 1)
            ->where('top', 1)
            ->where('publish_date', '<=', date('Y-m-d H:i'))
            ->orderBy('publish_date', 'desc')
            ->limit($limit)
            ->get();
    }

    public function getAllNewsHomepagePaging(array $excludeIds = [], int $onPage = 20)
    {
        return $this->where('active', 1)
            ->where('publish_date', '<=', date('Y-m-d H:i'))
            ->whereNotIn('id', $excludeIds)
            ->orderBy('publish_date', 'desc')
            ->orderBy('top', 'desc')
            ->paginate($onPage);
    }

    public function getNewsByCategoryId(int $categoryId, int $limit = 12)
    {
        return $this->where('active', 1)
            ->where('publish_date', '<=', date('Y-m-d H:i'))
            ->whereHas('categories', function ($query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->orderBy('publish_date', 'desc')
            ->paginate($limit);
    }

    public function searchNews(string $word, int $limit = 20)
    {
        $word = Helper::latinToCyrillic($word);

        $word = '+' . $word . '*';

        $titleOnly = $this->with(['i18n'])->where('active', 1)->whereHas('i18n', function ($query) use ($word) {
            $query->whereRaw("MATCH(title) AGAINST(? IN BOOLEAN MODE)", [$word])
                ->orderByRaw("LENGTH(title) DESC");
        });

        $descriptionOnly = $this->with(['i18n'])->where('active', 1)->whereHas('i18n', function ($query) use ($word) {
            $query->whereRaw("MATCH(description) AGAINST(? IN BOOLEAN MODE)", [$word])
                ->orderByRaw("LENGTH(description) DESC");
        });

        $titleAndDescription = $this->with(['i18n'])->where('active', 1)->whereHas('i18n', function ($query) use ($word) {
            $query->whereRaw("MATCH(title,description) AGAINST(? IN BOOLEAN MODE)", [$word])
                ->orderByRaw("(LENGTH(title) + LENGTH(description)) DESC");
        });

        $builder = $titleOnly
            ->union($titleAndDescription)
            ->union($descriptionOnly)
        ;

        return $builder->paginate($limit);
    }

    /* Static */
    public static function getPopularNews()
    {
        $totalCountNews = 6;

        $popularNews = self::where('active', 1)
            ->where('publish_date', '<=', date('Y-m-d H:i'))
            ->where('popular_posts', 1)
            ->orderBy('publish_date', 'desc')
            ->limit($totalCountNews)
            ->get();

        $remainingCountNews = $totalCountNews - $popularNews->count();

        if ($remainingCountNews) {
            $mostViewedNews = self::where('active', 1)
                ->where('publish_date', '<=', date('Y-m-d H:i'))
                ->where('popular_posts', 0)
                ->orderBy('views_month', 'desc')
                ->limit($remainingCountNews)
                ->get();

            $popularNews = $popularNews->merge($mostViewedNews);
        }

        return $popularNews;
    }

    /* Admin */
    public function getAdminAll(Request $request)
    {
        $word = $request->get('word');

        $builder = $this->with(['i18n']);

        if ($word) {
            $builder->whereHas('i18n', function ($query) use ($word) {
                $query->where('title', 'like', '%' . $word . '%');
            });
        }

        $builder->orderBy('id', 'desc');

        return $builder->paginate(10);
    }

    public static function getForSelectAdmin(int $excludeId = 0)
    {

        return self::with(['i18n' => function ($query) {
            $query->select('news_id', 'title as name')->orderBy('name', 'asc');
        }])
            ->where('id', '!=', $excludeId)
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * Retrieve the related municipality ID for the current news item.
     *
     * This method fetches the 'municipality_id' associated with the current news item's 'id'.
     *
     * @return int The ID of the related municipality.
     */
    public function getRelatedMunicipality(int $newId): int
    {
       return $this->where('id', $newId)->pluck('municipality_id', 'id')->first();
    }
}