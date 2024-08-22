<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\News;
use App\Models\Category;
use App\Models\Campaignable;
use App\Models\Campaign;
use App\Models\Book;
use App\Http\Traits\I18n;
use App\Http\Traits\FileUploadTrait;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminAuthorController;
use App\Helpers\Helper;
use App\Helpers\GlobalHelper;

class Author extends Model
{
    use SoftDeletes, I18n;

    const DIR = 'authors';

    // logo sizes
    const MAIN_SIZE = 41 . '_';
    const SIZES = [
        [300 => 300],
        [66 => 66],
        [41 => 41],
    ];

    protected $fillable = [
        'created_by',
        'updated_by',
        'logo',
        'slug',
        'active',
        'views',
        'views_day',
        'views_week',
        'views_month',
        'views_year',
    ];

    /* Relations */
    public function news()
    {
        return $this->belongsToMany(News::class, 'news_authors', 'author_id', 'news_id')->where('active', 1);
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
        return route('authors.show', $this->slug);
    }

    public function getDir()
    {
        return AdminController::MAIN_DIR . self::DIR . '/' . intval($this->id / 1000) . '/';
    }

    /* Static methods */
    public function getAuthorsAdmin(Request $request)
    {
        $word = $request->get('word');

        $builder = $this->with(['i18n'])->withCount('news');

        if ($word) {
            $builder->whereHas('i18n', function ($query) use ($word) {
                $query->where('fullname', 'like', '%' . $word . '%');
            });
        }

        #$builder->orderBy('i18n.fullname', 'ASC');
        $builder->orderBy('id', 'desc');

        return $builder->paginate(20);
    }

    public function getAuthorsAdminAll(Request $request)
    {
        $word = $request->get('word');

        $builder = $this->with(['i18n'])->withCount('news');

        if ($word) {
            $builder->whereHas('i18n', function ($query) use ($word) {
                $query->where('fullname', 'like', '%' . $word . '%');
            });
        }

        $builder->orderBy('id', 'desc');

        return $builder->get();
    }

    public static function getAuthorsForSelectAdmin()
    {
        return self::with(['i18n' => function ($query) {
            $query->select('author_id', 'fullname as name')->orderBy('name', 'asc');
        }])
            ->where('active', 1)
            ->orderBy('id', 'desc')
            ->get();
    }
}
