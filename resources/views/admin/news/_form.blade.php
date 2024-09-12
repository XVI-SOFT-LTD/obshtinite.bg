@include('admin.developer.fields._tree', [
    'label' => 'Категории',
    'name' => 'categories',
    'required' => true,
    'items' => $categories,
    'selected' => $selectedCats,
    'line' => true,
])

@include('admin.developer.fields._datetime', [
    'label' => 'Дата на публикуване',
    'id' => 'publish_date',
    'name' => 'publish_date',
    'required' => true,
    'value' => old('publish_date', isset($object) && $object->publish_date ? date('d.m.Y H:i', strtotime($object->publish_date)) : null),
    'line' => true,
    'now' => true,
    'hint' => 'Дата и час на публикуване на новината',
])

@include('admin.developer.fields._image', [
    'label' => 'Главна снимка',
    'id' => 'logo',
    'name' => 'logo',
    'required' => false,
    'value' => old('logo', $object->logo ?? null),
    'line' => true,
    'hint' => 'Главна снимка на новината',
])

@include('admin.developer.fields._gallery', [
    'label' => 'Галерия',
    'id' => 'gallery',
    'name' => 'gallery',
    'required' => false,
    'line' => true,
    'hint' => 'Може да качите няколко изображения наведнъж',
])

{{-- @include('admin.developer.fields._select', [
    'label' => 'Тип',
    'id' => 'status',
    'name' => 'status',
    'required' => true,
    'options' => $newsStatuses,
    'value' => old('status', $object->status ?? null),
    'line' => true,
]) --}}

@include('admin.developer.fields._checkbox', [
    'label' => 'Активна',
    'id' => 'active',
    'name' => 'active',
    'required' => false,
    'value' => old('active', $object->active ?? null),
    'checked' => old('active', $object->active ?? null) == '1' ? true : false,
    'line' => true,
    'hint' => 'Активирайте новината, за да бъде видима в сайта и за търсене',
])

@include('admin.developer.fields._checkbox', [
    'label' => 'ТОП новина',
    'id' => 'top',
    'name' => 'top',
    'required' => false,
    'value' => old('top', $object->top ?? null),
    'checked' => old('top', $object->top ?? null) == '1' ? true : false,
    'line' => true,
    'hint' => 'Добавя текущата новина в каре "ТОП новина"',
])

@include('admin.developer.fields._checkbox', [
    'label' => 'Покажи в популярни',
    'id' => 'popular_posts',
    'name' => 'popular_posts',
    'required' => false,
    'value' => old('popular_posts', $object->popular_posts ?? null),
    'checked' => old('popular_posts', $object->popular_posts ?? null) == '1' ? true : false,
    'line' => true,
    'hint' => 'Добавя текущата новина в каре "Популярни новини" (Ако няма избрани новини, ще се показват най-четените)',
])

@include('admin.developer.fields._textarea_autocomplete', [
    'label' => 'Автори',
    'placeholder' => 'Изберете автори',
    'id' => 'autocomplete_authors',
    'name' => 'authors',
    'required' => true,
    'items' => $authors,
    'selected' => $selectedAuthors,
    'line' => true,
    'multiple' => true,
])

@include('admin.developer.fields._textarea_autocomplete', [
    'label' => 'Свързани статии',
    'placeholder' => 'Изберете статии от списъка',
    'id' => 'autocomplete_news',
    'name' => 'related_news',
    'required' => false,
    'items' => $relatedNews,
    'selected' => $selectedRelatedNews,
    'line' => true,
    'multiple' => true,
])
