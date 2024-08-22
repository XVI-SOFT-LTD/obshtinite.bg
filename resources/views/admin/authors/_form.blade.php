@include('admin.developer.fields._image', [
    'label' => 'Снимка на автора',
    'text' => 'Текуща снимка на автора',
    'id' => 'logo',
    'name' => 'logo',
    'size' => '300_',
    'required' => false,
    'value' => old('logo', $object->logo ?? null),
    'hint' => 'Изберете изображение за автора (300x300px)',
])

@include('admin.developer.fields._checkbox', [
    'label' => 'Активен',
    'id' => 'active',
    'name' => 'active',
    'required' => false,
    'value' => old('active', $object->active ?? null),
    'checked' => old('active', $object->active ?? null) == '1' ? true : false,
    'line' => false,
])
