<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Municipality extends Model
{
    use HasFactory, SoftDeletes;

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
        'keywords',
        'active',
        'active_from',
        'active_to',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'working_hours' => 'array',
        'social_media_links' => 'array',
        'keywords' => 'array',
    ];
}