<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Models\Landmark;
use App\Http\Traits\I18n;
use App\Models\CustomButton;
use Illuminate\Http\Request;
use App\Models\MunicipalityGallery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Municipality extends Model
{
    use HasFactory, SoftDeletes, I18n;

    const DIR = 'municipality';
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

    protected $table = 'municipalities';

    protected $fillable = [
        'logo',
        'slug',
        'website',
        'contact_email',
        'contact_phone_one',
        'contact_phone_two',
        'longitude',
        'latitude',
        'position',
        'working_hours',
        'social_media_links',
        'area_id',
        'active',
        'active_from',
        'active_to',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'working_hours' => 'array',
        'social_media_links' => 'array',
    ];

    /**
     * Get the gallery for the municipality.
     *
     * @return HasMany
     */
    public function gallery(): HasMany
    {
        return $this->hasMany(MunicipalityGallery::class);
    }

    /**
     * Get all of the custom buttons for the municipality.
     *
     * This function defines a polymorphic one-to-many relationship.
     *
     * @return MorphMany
     */
    public function customButtons(): MorphMany
    {
        return $this->morphMany(CustomButton::class, 'buttonable');
    }

    /**
     * Retrieves the directory path for the Municipality model.
     *
     * This method returns the directory path for the Municipality model. The directory path is constructed based on the ID of the municipality.
     * The directory path is generated by concatenating the main directory path from the AdminController class, the constant DIR from the Municipality class,
     * and the result of dividing the ID of the municipality by 1000.
     *
     * @return string The directory path for the Municipality model.
     */
    public function getDir(): string
    {
        return AdminController::MAIN_DIR . self::DIR . '/' . intval($this->id / 1000) . '/';
    }

    /**
     * Retrieves the logo of the municipality.
     *
     * @param int $size The size of the logo. Defaults to 0.
     * @return string The URL of the logo.
     */
    public function getLogo(int $size = 0): string
    {
        if (!$size) {
            $size = self::MAIN_SIZE;
        } else {
            $size = $size . '_';
        }

        return Helper::getLogo($this->logo, $this->getDir(), $size);
    }

    /**
     * Get the URL for the municipality.
     *
     * @return string The URL for the municipality.
     */
    public function getUrl(): string
    {
        return route('municipality.show', ['slug' => $this->slug, 'id' => $this->id]);
    }

     /* Admin */
    /**
     * Retrieve all municipalities with optional filtering by name.
     *
     * @param Request $request The HTTP request object.
     *
     * @return object The collection of municipalities.
     */
    public function getAdminAll(Request $request): object
    {
        $word = $request->get('word');

        $builder = $this->with(['i18n']);

        if ($word) {
            $builder->whereHas('i18n', function ($query) use ($word) {
                $query->where('name', 'like', '%' . $word . '%');
            });
        }

        $builder->orderBy('id', 'desc');

        return $builder->paginate(10);
    }

    /**
     * Retrieve the municipalities for the admin select dropdown.
     *
     * @return Collection
     */
    public static function getMunicipalitiesForSelectAdmin(): Collection
    {
        return self::with(['i18n' => function ($query) {
            $query->select('municipality_id', 'name')->orderBy('name', 'asc');
        }])
            ->where('active', 1)
            ->whereNull('deleted_at')
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * Get the landmarks for the municipality.
     *
     * @return HasMany
     */
    public function landmarks(): HasMany
    {
        return $this->hasMany(Landmark::class);
    }

    /**
     * Retrieve the ID of the related area for a given municipality.
     *
     * @param int $municipalityId The ID of the municipality.
     * @return int|null The ID of the related area.
     */
    public function getRelatedArea(int $municipalityId): ?int
    {
        return $this->where('id', $municipalityId)->pluck('area_id', 'id')->first();
    }

    /**
     * Get the municipality that owns the landmark.
     *
     * @return BelongsTo
     */
    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    /**
     * Get the news associated with the municipality.
     *
     * This function defines a one-to-many relationship between the Municipality model
     * and the News model. It indicates that a municipality can have multiple news entries.
     *
     * @return HasMany
     */
    public function news() {
        return $this->hasMany(News::class);
    }

    /**
     * Retrieve all active municipalities for the homepage with pagination.
     *
     * This method fetches municipalities that are marked as active and have been updated
     * up to the current date and time. The results are ordered by the update timestamp
     * in descending order, followed by the ID in descending order. Only municipalities
     * that have not been soft-deleted are included in the results.
     *
     * @param int $onPage The number of municipalities to display per page. Default is 20.
     * @return LengthAwarePaginator Paginated list of municipalities.
     */
    public function getAllMunicipalitiesHomepagePaging(int $onPage = 20)
    {
        return $this->where('active', 1)
            ->where('updated_at', '<=', date('Y-m-d H:i'))
            ->orderBy('updated_at', 'desc')
            ->orderBy('id', 'desc')
            ->whereNull('deleted_at')
            ->paginate($onPage);
    }
    
    /**
     * Searches for Municipalities based on a given word.
     * The search is performed in three stages:
     * 1. Search in the 'name' field.
     * 2. Search in the 'description' field.
     * 3. Search in both 'name' and 'description' fields.
     * 
     * The search word is first converted from Latin to Cyrillic characters.
     * The search is performed using MySQL's full-text search in BOOLEAN MODE.
     * Results are ordered by the length of the matched field(s) in descending order.
     * 
     * @param string $word The search term to look for.
     * @param int $limit The number of results to return per page. Default is 20.
     * @return LengthAwarePaginator Paginated search results.
     */
    public function searchMunicipalities(string $word, int $limit = 20): LengthAwarePaginator
    {
        $word = Helper::latinToCyrillic($word);

        $word = '+' . $word . '*';

        $titleOnly = $this->with(['i18n'])->where('active', 1)->whereHas('i18n', function ($query) use ($word) {
            $query->whereRaw("MATCH(name) AGAINST(? IN BOOLEAN MODE)", [$word])
                ->orderByRaw("LENGTH(name) DESC");
        });

        // $descriptionOnly = $this->with(['i18n'])->where('active', 1)->whereHas('i18n', function ($query) use ($word) {
        //     $query->whereRaw("MATCH(description) AGAINST(? IN BOOLEAN MODE)", [$word])
        //         ->orderByRaw("LENGTH(description) DESC");
        // });

        // $titleAndDescription = $this->with(['i18n'])->where('active', 1)->whereHas('i18n', function ($query) use ($word) {
        //     $query->whereRaw("MATCH(name,description) AGAINST(? IN BOOLEAN MODE)", [$word])
        //         ->orderByRaw("(LENGTH(name) + LENGTH(description)) DESC");
        // });

        $builder = $titleOnly
            // ->union($titleAndDescription)
            // ->union($descriptionOnly)
        ;


        return $builder->paginate($limit);
    }
}