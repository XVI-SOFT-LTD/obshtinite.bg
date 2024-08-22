<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menus';

    protected $fillable = [
        'parent_id',
        'title',
        'url',
        'icon',
        'active',
        'created_at',
        'updated_at',
    ];

    public function childs()
    {
        return $this->hasMany('App\Models\Menu', 'parent_id', 'id');
    }
}
