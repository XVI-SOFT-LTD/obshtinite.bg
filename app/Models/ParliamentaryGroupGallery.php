<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Models\ParliamentaryGroup;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParliamentaryGroupGallery extends Model
{
    use HasFactory, SoftDeletes;
    
    /**
     *
     * The ParliamentaryGroupGallery model represents the parliamentary group gallery table in the database.
     */
    protected $table = 'parliamentary_group_gallery';

    /**
     * The directory path for the parliamentary group gallery.
     */
    protected $fillable = [
        'parliamentary_group_id',
        'filename',
        'sortorder'
    ];

    /**
     * Get the parliamentary group associated with the parliamentary group gallery.
     *
     * @return BelongsTo
     */
    public function parliamentaryGroup(): BelongsTo
    {
        return $this->belongsTo(ParliamentaryGroup::class);
    }

    /**
     * Returns the directory path for the parliamentary group gallery.
     *
     * @return string The directory path for the parliamentary group gallery.
     */
    public function getDir(): string
    {
        return AdminController::MAIN_DIR . ParliamentaryGroup::DIR_GALLERY . '/' . intval($this->parliamentary_group_id / 1000) . '/';
    }

    /**
     * Retrieve the image URL for the parliamentary group gallery.
     *
     * @param int $size The size of the image (default: 125).
     * @return string The URL of the image.
     */
    public function getImage(int $size = 125): string
    {
        return Helper::getLogo($this->filename, $this->getDir(), $size . '_');
    }
}