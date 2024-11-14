<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\I18n;
use App\Helpers\Helper;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class MegaBanner extends Model
{
     use HasFactory, SoftDeletes, I18n;

     const DIR = 'megabanner';

    // cover sizes
    const MAIN_SIZE = 386 . '_';
    const SIZES = [
        [960 => 480],
        [773 => 564],
        [386 => 282],
        [320 => 368],
        [69 => 69],
    ];

    protected $table = 'mega_banners';

    protected $fillable = [
        'logo',
        'active',
        'active_from',
        'active_to',
        'created_by',
        'updated_by',
    ];

    
    /**
     * Get the directory path for the MegaBanner instance.
     *
     * This method constructs the directory path by combining the main directory
     * from the AdminController, a constant directory from the MegaBanner class,
     * and a subdirectory based on the instance's ID divided by 1000.
     *
     * @return string The constructed directory path.
     */
    public function getDir(): string
    {
        return AdminController::MAIN_DIR . self::DIR . '/' . intval($this->id / 1000) . '/';
    }

    /**
     * Retrieves the logo of the megabanner.
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
     * Retrieve all megabanners with optional filtering by name.
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

}