<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Models\Participation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParticipationGallery extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'participations_gallery';

    protected $fillable = [
        'participation_id',
        'filename',
        'sortorder',
    ];

    /**
     * Get the participation associated with the participation gallery.
     *
     * @return BelongsTo
     */
    public function participation(): BelongsTo
    {
        return $this->belongsTo(Participation::class);
    }

     /**
     * Returns the directory path for the Participation gallery.
     *
     * @return string The directory path for the Participation gallery.
     */
    public function getDir(): string
    {
        return AdminController::MAIN_DIR . Participation::DIR_GALLERY . '/' . intval($this->participation_id / 1000) . '/';
    }

    /**
     * Retrieve the image URL for the Participation gallery.
     *
     * @param int $size The size of the image (default: 125).
     * @return string The URL of the image.
     */
    public function getImage(int $size = 125): string
    {
        return Helper::getLogo($this->filename, $this->getDir(), $size . '_');
    }
}