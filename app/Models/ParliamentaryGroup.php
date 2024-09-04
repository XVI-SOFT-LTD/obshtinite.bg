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
     * It is associated with the 'parliamentary_groups' database table.
     */
    protected $table = 'parliamentary_group';

    /**
     * The `ParliamentaryGroup` model represents a parliamentary group in the application.
     *
     * @property string $logo The logo of the parliamentary group.
     * @property string $slug The slug of the parliamentary group.
     * @property string $founding_date The founding date of the parliamentary group.
     * @property string $headquarters_address The headquarters address of the parliamentary group.
     * @property int $seats_in_parliament The number of seats the parliamentary group has in the parliament.
     * @property string $website The website of the parliamentary group.
     * @property string $founder_name The name of the founder of the parliamentary group.
     * @property string $contact_email The contact email of the parliamentary group.
     * @property string $contact_phone The contact phone number of the parliamentary group.
     * @property array $social_media_links The social media links of the parliamentary group.
     * @property bool $active Indicates if the parliamentary group is active.
     * @property int $created_by The ID of the user who created the parliamentary group.
     * @property int $updated_by The ID of the user who last updated the parliamentary group.
     */
    protected $fillable = [
        'logo',
        'slug',
        'founding_date',
        'headquarters_address',
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

    /**
     * Get the affiliated parties associated with the parliamentary group.
     *
     * @return BelongsToMany
     */
    public function affiliatedParties(): BelongsToMany
    {
        return $this->belongsToMany(ParliamentaryGroup::class, 'affiliated_party_parliamentary_group', 'parliamentary_group_id', 'affiliated_party_id');
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
}