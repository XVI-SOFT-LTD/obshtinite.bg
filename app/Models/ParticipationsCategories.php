<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Category;

class ParticipationsCategories extends Model
{
    use HasFactory;

    protected $table = 'participations_categories';

    protected $fillable = [
        'participation_id',
        'category_id',
    ];

    /**
     * Get the participation associated with the categories.
     *
     * @return BelongsTo
     */
    public function categories()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Define a relationship where each ParticipationCategory belongs to a Participation.
     *
     * @return BelongsTo
     */
    public function participations()
    {
        return $this->belongsTo(Participation::class);
    }

    
    /**
     * Retrieve the related associations for a given participation.
     *
     * @param int $participationId The ID of the participation.
     * @return array The related associations as an associative array with the category ID as the key and the ID as the value.
     */
    public function getRelatedAssoc(int $participationId)
    {
        return $this->where('participation_id', $participationId)->pluck('category_id', 'id')->toArray();
    }
}