@include('admin.developer.fields._checkbox', [
    'label' => 'Активна',
    'id' => 'active',
    'name' => 'active',
    'required' => false,
    'value' => old('active', $object->active ?? null),
    'checked' => old('active', $object->active ?? null) == '1' ? true : false,
    'line' => false,
    'hint' => 'Активирайте, за да бъде видима в сайта',
])
