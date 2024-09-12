@include('admin.developer.fields._input', [
    'label' => 'Longitude',
    'id' => 'longitude',
    'name' => 'longitude',
    'required' => true,
    'value' => old('longitude', $object->longitude ?? null),
    'hint' => 'Географска дължина',
    'line' => true,
])

@include('admin.developer.fields._input', [
    'label' => 'Latitude',
    'id' => 'latitude',
    'name' => 'latitude',
    'required' => true,
    'value' => old('latitude', $object->latitude ?? null),
    'hint' => 'Географска ширина',
    'line' => true,
])

@include('admin.developer.fields._input', [
    'label' => 'Работно време',
    'id' => 'working_hours',
    'name' => 'working_hours',
    'required' => true,
    'value' => old('working_hours', $object->working_hours ?? null),
    'line' => true,
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

@include('admin.developer.fields._gallery', [
    'label' => 'Галерия',
    'id' => 'gallery',
    'name' => 'gallery',
    'required' => false,
    'line' => true,
    'hint' => 'Може да качите няколко изображения наведнъж',
])

@include('admin.developer.fields._textarea_autocomplete', [
    'label' => 'Община',
    'placeholder' => 'Изберете община от списъка',
    'id' => 'municipality_id',
    'name' => 'municipality_id',
    'required' => true,
    'items' => $municipalities,
    'selected' => $selectedMunicipalities,
    'line' => true,
    'multiple' => false,
])

@include('admin.developer.fields._checkbox', [
    'label' => 'Активна',
    'id' => 'active',
    'name' => 'active',
    'required' => false,
    'value' => old('active', $object->active ?? null),
    'checked' => old('active', $object->active ?? null) == '1' ? true : false,
    'line' => true,
    'hint' => 'Активирайте забележителността, за да бъде видима в сайта и за търсене',
])