<?php

namespace App\Models;

use App\Models\ParliamentaryGroup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AffiliatedParliamentaryGroup extends Model
{
    use HasFactory;

    protected $table = 'affiliated_p_pg';

    protected $fillable = [
        'parliamentary_group_id',
        'affiliated_party_id',
    ];

    /**
     * Get the parliamentary group associated with the affiliated parliamentary group.
     *
     * @return BelongsTo
     */
    public function parliamentaryGroups()
    {
        return $this->belongsTo(ParliamentaryGroup::class);
    }

    /**
     * Retrieve the related associations for a given parliamentary group.
     *
     * @param int $parliamentaryGroupId The ID of the parliamentary group.
     * @return array The related associations as an associative array with the affiliated party ID as the key and the ID as the value.
     */
    public function getRelatedAssoc(int $parliamentaryGroupId)
    {
        return $this->where('parliamentary_group_id', $parliamentaryGroupId)->pluck('affiliated_party_id', 'id')->toArray();
    }
}