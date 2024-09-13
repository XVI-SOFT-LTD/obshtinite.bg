<?php

namespace App\Models;

use App\Models\Area;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Area_i18n extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'areas_i18n';

    protected $fillable = [
        'area_id',
        'language_id',
        'name',
        'description',
    ];

    /**
     * Get the area that owns the area_i18n.
     *
     * @return BelongsTo
     */
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    /**
     * Get the language that belongs to the area.
     *
     * @return BelongsTo
     */
    public function language()
    {
        return $this->belongsTo(Language::class);
    }

}