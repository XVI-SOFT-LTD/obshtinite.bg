<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'image',
        ];
    }
}
