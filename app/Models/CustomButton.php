<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Http\Traits\I18n;
use App\Models\CustomButtonGallery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomButton extends Model
{
     use HasFactory, SoftDeletes, I18n;

    const DIR = 'custom_button';
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

    protected $table = 'custom_buttons';

    protected $fillable = [
        'name',
        'slug',
        'active',
        'description',
        'logo',
        'buttonable_id',
        'buttonable_type',
    ];

    public function buttonable()
    {
        return $this->morphTo();
    }

    /**
     * Get the gallery for the buttons.
     *
     * @return HasMany
     */
    public function gallery(): HasMany
    {
        return $this->hasMany(CustomButtonGallery::class);
    }

     public function getDir(): string
    {
        return AdminController::MAIN_DIR . self::DIR . '/' . intval($this->id / 1000) . '/';
    }

    public function getLogo(int $size = 0): string
    {
        if (!$size) {
            $size = self::MAIN_SIZE;
        } else {
            $size = $size . '_';
        }

        return Helper::getLogo($this->logo, $this->getDir(), $size);
    }

      public function getImage(int $size = 125): string
    {
        return Helper::getLogo($this->filename, $this->getDir(), $size . '_');
    }
}