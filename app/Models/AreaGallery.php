<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Models\Area;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AreaGallery extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'areas_gallery';

    protected $fillable = [
        'area_id',
        'filename',
        'sortorder',
    ];

    /**
     * Get the area associated with the area gallery.
     *
     * @return BelongsTo
     */
    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

     /**
     * Returns the directory path for the Area gallery.
     *
     * @return string The directory path for the Area gallery.
     */
    public function getDir(): string
    {
        return AdminController::MAIN_DIR . Area::DIR_GALLERY . '/' . intval($this->area_id / 1000) . '/';
    }

    /**
     * Retrieve the image URL for the Area gallery.
     *
     * @param int $size The size of the image (default: 125).
     * @return string The URL of the image.
     */
    public function getImage(int $size = 125): string
    {
        return Helper::getLogo($this->filename, $this->getDir(), $size . '_');
    }

}