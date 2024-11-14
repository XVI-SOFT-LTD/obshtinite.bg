<?php

namespace App\Models;

use App\Models\Area;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Municipality;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BannersAreasMunicipalities extends Model
{
    use HasFactory;

    protected $table = 'banners_areas_municipalities';

    protected $fillable = [
        'banner_id',
        'area_id',
        'municipality_id',
    ];

    /**
     * Define a relationship where each BannersAreasMunicipalities belongs to a Areas.
     *
     * @return BelongsTo
     */
    public function areas()
    {
        return $this->belongsTo(Area::class);
    }

    /**
     * Define a relationship where each BannersAreasMunicipalities belongs to a Banner.
     *
     * @return BelongsTo
     */
    public function banners()
    {
        return $this->belongsTo(Banner::class);
    }

    /**
     * Define a relationship where each BannersAreasMunicipalities belongs to a Municipality.
     *
     * @return BelongsTo
     */
    public function municipalities()
    {
        return $this->belongsTo(Municipality::class);
    }

    
    /**
     * Retrieve the related associations for a given banner.
     *
     * @param int $bannerId The ID of the banner.
     * @return array The related associations as an associative array with the category ID as the key and the ID as the value.
     */
    public function getRelatedAssoc(int $bannerId)
    {
        return $this->where('banner_id', $bannerId)
                ->get(['area_id', 'municipality_id'])
                ->flatMap(function ($item) {
                    return [
                        $item->area_id,
                        $item->municipality_id,
                    ];
                })
                ->toArray();
    }

}