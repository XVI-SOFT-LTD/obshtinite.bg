@include('admin.developer.fields._input', [
    'label' => 'Телефон за контакт 1',
    'id' => 'contact_phone_one',
    'name' => 'contact_phone_one',
    'required' => true,
    'value' => old('contact_phone_one', $object->contact_phone_one ?? null),
    'hint' => 'Телефон за контакт',
    'line' => true,
])

@include('admin.developer.fields._input', [
    'label' => 'Телефон за контакт 2',
    'id' => 'contact_phone_two',
    'name' => 'contact_phone_two',
    'required' => false,
    'value' => old('contact_phone_two', $object->contact_phone_two ?? null),
    'hint' => 'Телефон за контакт',
    'line' => true,
])

@include('admin.developer.fields._input', [
    'label' => 'Имейл за контакт',
    'id' => 'contact_email',
    'name' => 'contact_email',
    'required' => true,
    'value' => old('contact_email', $object->contact_email ?? null),
    'hint' => 'Имейл за контакт',
    'line' => true,
])

@include('admin.developer.fields._social_media_input', [
    'label' => 'Website',
    'id' => 'website',
    'name' => 'website',
    'value' => old('website', $object->website ?? null),
    'hint' => 'Сайт',
    'line' => true,
    'required' => false,
])

@include('admin.developer.fields._social_media_input', [
    'label' => 'Facebook',
    'id' => 'social_media_facebook',
    'name' => 'social_media_links[facebook]',
    'value' => old('social_media_links.facebook', $object->social_media_links['facebook'] ?? ''),
    'hint' => 'Въведете URL адреса на вашата Facebook страница',
    'line' => true,
    'required' => false,
])

@include('admin.developer.fields._social_media_input', [
    'label' => 'Google',
    'id' => 'social_media_google',
    'name' => 'social_media_links[google]',
    'value' => old('social_media_links.google', $object->social_media_links['google'] ?? ''),
    'hint' => 'Въведете URL адреса на вашата Google страница',
    'line' => true,
    'required' => false,
])

@include('admin.developer.fields._social_media_input', [
    'label' => 'Видео от YouTube',
    'id' => 'social_media_youtube',
    'name' => 'social_media_links[youtube]',
    'value' => old('social_media_links.youtube', $object->social_media_links['youtube'] ?? ''),
    'hint' => 'Въведете URL адреса от YouTube',
    'line' => true,
    'required' => false,
])

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

@include('admin.developer.fields._number_input', [
    'label' => 'Позиция',
    'id' => 'position',
    'name' => 'position',
    'required' => false,
    'value' => old('position', $object->position ?? null),
    'hint' => 'Позицията на участието в списъка',
    'line' => true,
])

{{-- @include('admin.developer.fields._textarea_autocomplete', [
    'label' => 'Абонамент',
    'placeholder' => 'Изберете абонамент от списъка',
    'id' => 'subscription',
    'name' => 'subscription',
    'required' => false,
    'items' => ,
    'selected' => ,
    'line' => true,
    'multiple' => false,
]) --}}

@include('admin.developer.fields._textarea_autocomplete', [
    'label' => 'Област',
    'placeholder' => 'Изберете Област от списъка',
    'id' => 'area_id',
    'name' => 'area_id',
    'required' => true,
    'items' => $areas,
    'selected' => $selectedArea,
    'line' => true,
    'multiple' => false,
])

@include('admin.developer.fields._tree', [
    'label' => 'Категории',
    'name' => 'categories',
    'required' => true,
    'items' => $categories,
    'selected' => $selectedCategories,
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

@include('admin.developer.fields._gallery', [
    'label' => 'Галерия',
    'id' => 'gallery',
    'name' => 'gallery',
    'required' => false,
    'line' => true,
    'hint' => 'Може да качите няколко изображения наведнъж',
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

