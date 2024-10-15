<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Http\Traits\I18n;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\ParliamentaryGroupGallery;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        'updated_by'
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
     * @return Collection The collection of parliamentary groups.
     */
    public function getAdminAll(Request $request): Collection
    {
        $word = $request->get('word');

        $builder = $this->with(['i18n']);

        if ($word) {
            $builder->whereHas('i18n', function ($query) use ($word) {
                $query->where('title', 'like', '%' . $word . '%');
            });
        }

        $builder->orderBy('id', 'desc');

        return $builder->get();
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
    public function getAllParliamentaryGroupHomepagePaging(int $onPage = 20)
    {
        return $this->where('active', 1)
            ->where('updated_at', '<=', date('Y-m-d H:i'))
            ->orderBy('updated_at', 'desc')
            ->orderBy('id', 'desc')
            ->whereNull('deleted_at')
            ->paginate($onPage);
    }
}