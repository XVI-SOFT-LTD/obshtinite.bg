<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Admin\AdminFormRequest;

class CategoryRequest extends AdminFormRequest
{
    public function rules()
    {
        return [
            'i18n.1.name' => 'required|string',
            'parent_id' => 'nullable|integer',
            'order' => 'nullable|integer',
            'show_mobile' => 'nullable|boolean',
            'active' => 'nullable|boolean',
        ];
    }

    public function attributes()
    {
        return [
            'i18n.1.name' => 'Име на категория (BG)',
            'i18n.2.name' => 'Име на категория (EN)',
        ];
    }
}
