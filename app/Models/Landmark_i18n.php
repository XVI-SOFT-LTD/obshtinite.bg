<?php

namespace App\Models;

use Faker\Provider\sv_SE\Municipality;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Landmark_i18n extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'landmarks_i18n';

    protected $fillable = [
        'landmark_id',
        'language_id',
        'name',
        'description',
        
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