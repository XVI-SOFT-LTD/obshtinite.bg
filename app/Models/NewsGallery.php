<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\News;
use App\Http\Controllers\Admin\AdminController;
use App\Helpers\Helper;

class NewsGallery extends Model
{
    use SoftDeletes;

    protected $table = 'news_gallery';

    protected $fillable = [
        'news_id',
        'filename',
        'sortorder',
    ];

    public function book()
    {
        return $this->belongsTo(News::class);
    }

    public function getDir()
    {
        return AdminController::MAIN_DIR . News::DIR_GALLERY . '/' . intval($this->news_id / 1000) . '/';
    }

    public function getImage(int $size = 125)
    {
        return Helper::getLogo($this->filename, $this->getDir(), $size . '_');
    }

}
