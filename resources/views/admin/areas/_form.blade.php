@include('admin.developer.fields._social_media_input', [
    'label' => 'Website',
    'id' => 'website',
    'name' => 'website',
    'value' => old('website', $object->website ?? null),
    'hint' => 'Сайт на общината',
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

@include('admin.developer.fields._input', [
    'label' => 'Телефон за контакт',
    'id' => 'contact_phone',
    'name' => 'contact_phone',
    'required' => false,
    'value' => old('contact_phone', $object->contact_phone ?? null),
    'hint' => 'Телефон за контакт с областния център',
    'line' => true,
])

@include('admin.developer.fields._input', [
    'label' => 'Имейл за контакт',
    'id' => 'contact_email',
    'name' => 'contact_email',
    'required' => false,
    'value' => old('contact_email', $object->contact_email ?? null),
    'hint' => 'Имейл за контакт с областния център',
    'line' => true,
])

@include('admin.developer.fields._number_input', [
    'label' => 'Население',
    'id' => 'population',
    'name' => 'population',
    'required' => true,
    'value' => old('population', $object->population ?? null),
    'hint' => 'Население на Областта',
    'line' => true,
])

@include('admin.developer.fields._input', [
    'label' => 'Площ',
    'id' => 'area',
    'name' => 'area',
    'required' => true,
    'value' => old('area', $object->area ?? null),
    'line' => true,
])


@include('admin.developer.fields._image', [
    'label' => 'Главна снимка',
    'id' => 'logo',
    'name' => 'logo',
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

@include('admin.developer.fields._checkbox', [
    'label' => 'Активна',
    'id' => 'active',
    'name' => 'active',
    'required' => false,
    'value' => old('active', $object->active ?? null),
    'checked' => old('active', $object->active ?? null) == '1' ? true : false,
    'hint' => 'Активирайте общината, за да бъде видима в сайта и за търсене',
])

