<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Traits\I18n;
use App\Models\ParliamentaryGroupGallery;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class ParliamentaryGroup extends Model
{
    use HasFactory, I18n, SoftDeletes;

    const DIR = 'parliamentary_group';
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

    /**
     *
     * The ParliamentaryGroup model represents a parliamentary group in the application.
     * It is associated with the 'parliamentary_group' database table.
     */
    protected $table = 'parliamentary_group';

    /**
     * The `ParliamentaryGroup` model represents a parliamentary group in the application.
     */
    protected $fillable = [
        'logo',
        'slug',
        'founding_date',
        'seats_in_parliament',
        'website',
        'founder_name',
        'contact_email',
        'contact_phone',
        'social_media_links',
        'active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'social_media_links' => 'array',
    ];

    /**
     * Get the affiliated parties associated with the parliamentary group.
     *
     * @return BelongsToMany
     */
    public function affiliatedParties(): BelongsToMany
    {
        return $this->belongsToMany(ParliamentaryGroup::class, 'affiliated_p_pg', 'parliamentary_group_id', 'affiliated_party_id');
    }

    /**
     * Get the gallery associated with the parliamentary group.
     *
     * @return HasMany
     */
    public function gallery(): HasMany
    {
        return $this->hasMany(ParliamentaryGroupGallery::class);
    }

    /**
     * Retrieves the directory path for the ParliamentaryGroup model.
     *
     * @return string The directory path for the ParliamentaryGroup model.
     */
    public function getDir(): string
    {
        return AdminController::MAIN_DIR . self::DIR . '/' . intval($this->id / 1000) . '/';
    }

    public function getUrl()
    {
        return route('parliamentaryGroup.show', ['slug' => $this->slug, 'id' => $this->id]);
    }

    /**
     * Retrieves the logo of the parliamentary group.
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

    /* Admin */
    /**
     * Retrieve all parliamentary groups with optional filtering by word.
     *
     * @param Request $request The HTTP request object.
     * @return object The collection of parliamentary groups.
     */
    public function getAdminAll(Request $request): object
    {
        $word = $request->get('word');

        $builder = $this->with(['i18n']);

        if ($word) {
            $builder->whereHas('i18n', function ($query) use ($word) {
                $query->where('title', 'like', '%' . $word . '%');
            });
        }

        $builder->orderBy('id', 'desc');

        return $builder->paginate(10);
    }

    /**
     * Retrieve the parliamentary groups for admin selection.
     *
     * @param int $excludeId The ID of the parliamentary group to exclude (optional).
     * @return Collection
     */
    public static function getForSelectAdmin(int $excludeId = 0)
    {
        return self::with(['i18n' => function ($query) {
            $query->select('parliamentary_group_id', 'name')->orderBy('name', 'asc');
        }])
            ->where('id', '!=', $excludeId)
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * Retrieve all active parliamentary groups for the homepage with pagination.
     *
     * This method fetches all parliamentary groups that are marked as active and have been updated
     * up to the current date and time. The results are ordered by the updated date and ID in descending order.
     * It also ensures that the groups have not been soft-deleted.
     *
     * @param int $onPage The number of items to display per page. Default is 20.
     * @return LengthAwarePaginator Paginated list of parliamentary groups.
     */
    public function getAllParliamentaryGroupHomepage(int $limit = 12)
    {
        return $this->where('active', 1)
            ->orderBy('id', 'desc')
            ->whereNull('deleted_at')
            ->take($limit)
            ->get();
    }

    /**
     * Searches for parliamentary groups based on a given word.
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
    public function searchParliamentaryGroups(string $word, int $limit = 20): LengthAwarePaginator
    {
        $word = Helper::latinToCyrillic($word);

        $word = '+' . $word . '*';

        $titleOnly = $this->with(['i18n'])->where('active', 1)->whereHas('i18n', function ($query) use ($word) {
            $query->whereRaw("MATCH(name) AGAINST(? IN BOOLEAN MODE)", [$word])
                ->orderByRaw("LENGTH(name) DESC");
        });

        $descriptionOnly = $this->with(['i18n'])->where('active', 1)->whereHas('i18n', function ($query) use ($word) {
            $query->whereRaw("MATCH(description) AGAINST(? IN BOOLEAN MODE)", [$word])
                ->orderByRaw("LENGTH(description) DESC");
        });

        $titleAndDescription = $this->with(['i18n'])->where('active', 1)->whereHas('i18n', function ($query) use ($word) {
            $query->whereRaw("MATCH(name,description) AGAINST(? IN BOOLEAN MODE)", [$word])
                ->orderByRaw("(LENGTH(name) + LENGTH(description)) DESC");
        });

        $builder = $titleOnly
            ->union($titleAndDescription)
            ->union($descriptionOnly)
        ;

        return $builder->paginate($limit);
    }
}
