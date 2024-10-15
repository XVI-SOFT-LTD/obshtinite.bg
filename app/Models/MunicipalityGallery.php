<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Models\Municipality;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MunicipalityGallery extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'municipalities_gallery';

    protected $fillable = [
        'municipality_id',
        'filename',
        'sortorder',
    ];

    /**
     * Get the municipality associated with the municipality gallery.
     *
     * @return BelongsTo
     */
    public function municipality(): BelongsTo
    {
        return $this->belongsTo(Municipality::class);
    }

     /**
     * Returns the directory path for the Municipality gallery.
     *
     * @return string The directory path for the Municipality gallery.
     */
    public function getDir(): string
    {
        return AdminController::MAIN_DIR . Municipality::DIR_GALLERY . '/' . intval($this->municipality_id / 1000) . '/';
    }

    /**
     * Retrieve the image URL for the Municipality gallery.
     *
     * @param int $size The size of the image (default: 125).
     * @return string The URL of the image.
     */
    public function getImage(int $size = 125): string
    {
        return Helper::getLogo($this->filename, $this->getDir(), $size . '_');
    }
    
}