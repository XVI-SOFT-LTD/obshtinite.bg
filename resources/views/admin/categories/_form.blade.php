@include('admin.developer.fields._select', [
    'label' => 'Към главна категория',
    'id' => 'parent_id',
    'name' => 'parent_id',
    'required' => false,
    'value' => old('parent_id', $object->parent_id ?? ''),
    'options' => $categoryOptions,
    'hint' => 'Ако не изберете главна категория, тази категория ще бъде главна.',
])

@include('admin.developer.fields._checkbox', [
    'label' => 'Активна',
    'id' => 'active',
    'name' => 'active',
    'required' => false,
    'value' => old('active', $object->active ?? null),
    'checked' => old('active', $object->active ?? null) == '1' ? true : false,
])
