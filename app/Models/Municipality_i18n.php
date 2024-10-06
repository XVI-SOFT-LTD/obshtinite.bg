<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Municipality_i18n extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'municipalities_i18n';

    protected $fillable = [
        'municipality_id',
        'language_id',
        'name',
        'description',
        'address',
        'keywords',
    ];

    protected $casts = [
        'keywords' => 'array',
    ];

    /**
     * Get the municipality that owns the municipality_i18n.
     *
     * @return BelongsTo
     */
    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    /**
     * Get the language that belongs to the municipality.
     *
     * @return BelongsTo
     */
    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}