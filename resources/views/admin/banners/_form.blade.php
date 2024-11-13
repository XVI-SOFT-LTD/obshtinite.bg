@include('admin.developer.fields._social_media_input', [
    'label' => 'Линк',
    'id' => 'url',
    'name' => 'url',
    'value' => old('url', $object->url ?? null),
    'hint' => 'Въведете Линк',
    'line' => true,
    'required' => false,
])


@include('admin.developer.fields._number_input', [
    'label' => 'Позиция',
    'id' => 'position',
    'name' => 'position',
    'required' => false,
    'value' => old('position', $object->position ?? null),
    'hint' => 'Позицията на участието в списъка',
    'line' => true,
])

@include('admin.developer.fields._tree', [
    'label' => 'Област/Община',
    'placeholder' => 'Изберете Област и Община от списъка',
    'name' => 'areas',
    'required' => true,
    'items' => $areas,
    'selected' => $selectedAreas,
    'line' => true,
])

@include('admin.developer.fields._tree', [
    'label' => 'Категории',
    'name' => 'categories',
    'required' => true,
    'items' => $categories,
    'selected' => $selectedCategories,
    'line' => true,
])

@include('admin.developer.fields._datetime', [
    'label' => 'Активно от',
    'id' => 'active_from',
    'name' => 'active_from',
    'required' => true,
    'value' => old('active_from', isset($object) && $object->active_from ? date('d.m.Y H:i', strtotime($object->active_from)) : null),
    'line' => true,
    'now' => true,
    'hint' => 'Дата и час на активиране на участието',
])

@include('admin.developer.fields._datetime', [
    'label' => 'Активно до',
    'id' => 'active_to',
    'name' => 'active_to',
    'required' => true,
    'value' => old('active_to', isset($object) && $object->active_to ? date('d.m.Y H:i', strtotime($object->active_to)) : null),
    'line' => true,
    'now' => true,
    'hint' => 'Дата и час на деактивиране на участието',
])

@include('admin.developer.fields._image', [
    'label' => 'Главна снимка',
    'id' => 'logo',
    'name' => 'logo',
    'required' => false,
    'value' => old('logo', $object->logo ?? null),
    'line' => true,
    'hint' => 'Главна снимка на участието',
])

@include('admin.developer.fields._checkbox', [
    'label' => 'Активна',
    'id' => 'active',
    'name' => 'active',
    'required' => false,
    'value' => old('active', $object->active ?? null),
    'checked' => old('active', $object->active ?? null) == '1' ? true : false,
    'line' => true,
    'hint' => 'Активирайте участието, за да бъде видимо в сайта и за търсене',
])

@include('admin.developer.fields._checkbox', [
    'label' => 'Homepage',
    'id' => 'homepage',
    'name' => 'homepage',
    'required' => false,
    'value' => old('homepage', $object->homepage ?? null),
    'checked' => old('homepage', $object->homepage ?? null) == '1' ? true : false,
    'line' => true,
    'hint' => 'Активирайте банера, за да бъде видим на началната страница',
])

