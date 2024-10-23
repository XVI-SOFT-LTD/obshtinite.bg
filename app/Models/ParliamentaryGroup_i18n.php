<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParliamentaryGroup_i18n extends Model
{
    use HasFactory, SoftDeletes;

    /**
     *
     * Class ParliamentaryGroupI18n
     *
     * This class represents the model for the 'parliamentary_group_i18n' table.
     */
    protected $table = 'parliamentary_group_i18n';

    /**
     * Model: ParliamentaryGroupI18n
     * 
     * This model represents the translation of parliamentary group information in different languages.
     * 
     * @property int $parliamentary_group_id The ID of the parliamentary group.
     * @property int $language_id The ID of the language.
     * @property string $name The name of the parliamentary group.
     * @property string $leader_name The name of the leader of the parliamentary group.
     * @property string $description The description of the parliamentary group.
     */
    protected $fillable = [
        'parliamentary_group_id',
        'language_id',
        'name',
        'leader_name',
        'description',
        'headquarters_address',
    ];
}