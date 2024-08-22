<?php

namespace App\Helpers;

use App\Models\Category;

class DropDownHelper
{
    public static function defaultValueDropDown()
    {
        return [
            0 => '-- изберете опция --',
        ];
    }

    /* Administration */
    public static function getCategories()
    {
        $categories = Category::with('i18n')->get()->pluck('i18n.name', 'id')->sortBy('i18n.name')->toArray();
        return self::defaultValueDropDown() + $categories;
    }

    public static function getNewsStatuses()
    {
        return [
            'draft' => 'Чернова',
            'published' => 'Публикувана',
            'archived' => 'Архивирана',
            'trash' => 'В кошчето',
        ];
    }
}
