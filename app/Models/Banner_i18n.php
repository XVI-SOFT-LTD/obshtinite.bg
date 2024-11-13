<?php

namespace App\Models;

use App\Models\Banner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banner_i18n extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'banners_i18n';

    protected $fillable = [
        'banner_id',
        'language_id',
        'name',
        'keywords',
    ];

    protected $casts = [
        'keywords' => 'array',
    ];

    
    /**
     * Get the participation that owns the Participation_i18n.
     *
     * @return BelongsTo
     */
    public function banner()
    {
        return $this->belongsTo(Banner::class);
    }

    /**
     * Get the language associated with the participation.
     *
     * This function defines a relationship where the participation belongs to a language.
     *
     * @return BelongsTo
     */
    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}