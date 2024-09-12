<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Models\Landmark;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LandmarkGallery extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'landmarks_gallery';

    protected $fillable = [
        'landmark_id',
        'filename',
        'sortorder',
    ];
    
    /**
     * Get the landmark associated with the landmark gallery.
     *
     * @return BelongsTo
     */
    public function municipality(): BelongsTo
    {
        return $this->belongsTo(Landmark::class);
    }

     /**
     * Returns the directory path for the Landmark gallery.
     *
     * @return string The directory path for the Landmark gallery.
     */
    public function getDir(): string
    {
        return AdminController::MAIN_DIR . Landmark::DIR_GALLERY . '/' . intval($this->landmark_id / 1000) . '/';
    }

    /**
     * Retrieve the image URL for the Landmark gallery.
     *
     * @param int $size The size of the image (default: 125).
     * @return string The URL of the image.
     */
    public function getImage(int $size = 125): string
    {
        return Helper::getLogo($this->filename, $this->getDir(), $size . '_');
    }
}