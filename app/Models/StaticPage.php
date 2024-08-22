<?php

namespace App\Models;

use App\Http\Traits\I18n;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StaticPage extends Model
{
    use SoftDeletes, I18n;

    protected $table = 'static_pages';

    protected $fillable = [
        'created_by',
        'updated_by',
        'slug',
        'picture',
        'active',
        'views',
        'views_day',
        'views_week',
        'views_month',
        'views_year',
    ];

    public function getAdmin($request)
    {
        $word = $request->get('word');

        $builder = $this->with(['i18n']);

        if ($word) {
            $builder->whereHas('i18n', function ($query) use ($word) {
                $query->where('title', 'like', '%' . $word . '%');
            });
        }

        $builder->orderBy('id', 'desc');

        return $builder->paginate(20);
    }
}
