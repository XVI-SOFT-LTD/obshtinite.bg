<?php

namespace App\Models;

use App\Models\Banner;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BannersCategories extends Model
{
    use HasFactory;

    protected $table = 'banners_categories';

    protected $fillable = [
        'banner_id',
        'category_id',
    ];

    /**
     * Get the banner associated with the categories.
     *
     * @return BelongsTo
     */
    public function categories()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Define a relationship where each BannerCategory belongs to a Banner.
     *
     * @return BelongsTo
     */
    public function banners()
    {
        return $this->belongsTo(Banner::class);
    }

    
    /**
     * Retrieve the related associations for a given banner.
     *
     * @param int $bannerId The ID of the banner.
     * @return array The related associations as an associative array with the category ID as the key and the ID as the value.
     */
    public function getRelatedAssoc(int $bannerId)
    {
        return $this->where('banner_id', $bannerId)->pluck('category_id', 'id')->toArray();
    }
}