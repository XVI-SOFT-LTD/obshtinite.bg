@include('admin.developer.fields._datetime', [
    'label' => 'Активно от',
    'id' => 'active_from',
    'name' => 'active_from',
    'required' => true,
    'value' => old('active_from', isset($object) && $object->active_from ? date('d.m.Y H:i', strtotime($object->active_from)) : null),
    'line' => true,
    'now' => true,
    'hint' => 'Дата и час на активиране на общината',
])

@include('admin.developer.fields._datetime', [
    'label' => 'Активно до',
    'id' => 'active_to',
    'name' => 'active_to',
    'required' => true,
    'value' => old('active_to', isset($object) && $object->active_to ? date('d.m.Y H:i', strtotime($object->active_to)) : null),
    'line' => true,
    'now' => true,
    'hint' => 'Дата и час на деактивиране на общината',
])

@include('admin.developer.fields._image', [
    'label' => 'Главна снимка',
    'id' => 'logo',
    'name' => 'logo',
    'required' => false,
    'value' => old('logo', $object->logo ?? null),
    'line' => true,
    'hint' => 'Главна снимка на общината',
])

@include('admin.developer.fields._checkbox', [
    'label' => 'Активна',
    'id' => 'active',
    'name' => 'active',
    'required' => false,
    'value' => old('active', $object->active ?? null),
    'checked' => old('active', $object->active ?? null) == '1' ? true : false,
    'line' => true,
    'hint' => 'Активирайте банера, за да бъде видима в сайта',
])

