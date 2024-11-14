<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MegaBanner_i18n extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mega_banners_i18n';

    protected $fillable = [
        'mega_banner_id',
        'language_id',
        'name'
    ];

    /**
     * Get the language that belongs to the mega banner.
     *
     * @return BelongsTo
     */
    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}