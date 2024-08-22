<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" @isset($id) for="{{ $id }}" @endisset>

        {{ $label }}

        @if (isset($required) && $required)
            <span class="required">*</span>
        @endif
    </label>
    <div class="col-md-9 col-sm-9 col-xs-12">
        <ul class="list-style-type-none" style="padding: 0px;">
            @foreach ($items as $item)
                @php
                    $mainCategorySelected = isset($selected) && in_array($item->id, $selected);
                @endphp
                <li>
                    <div class="checkbox">
                        <label for="parent_{{ $item->id }}">
                            <input class="form-check-input" type="checkbox" name="{{ $name }}[]" @isset($item->id) id="parent_{{ $item->id }}" @endisset
                                value="{{ $item->id }}" @if ((old($name) && in_array($item->id, old($name))) || $mainCategorySelected) checked @endif />
                            {{ $item->i18n->name }}
                        </label>
                    </div>
                    @if ($item->childs->count() > 0)
                        <ul class="list-style-type-none child-category" style="padding-left: 20px; display: {{ $mainCategorySelected ? 'block' : 'none' }};">
                            @foreach ($item->childs as $child)
                                <li>
                                    <div class="checkbox">
                                        <label for="child_{{ $child->id }}">
                                            <input class="form-check-input" type="checkbox" name="{{ $name }}[]" @isset($child->id) id="child_{{ $child->id }}" @endisset
                                                value="{{ $child->id }}" @if ((old($name) && in_array($child->id, old($name))) || (isset($selected) && in_array($child->id, $selected))) checked @endif />
                                            {{ $child->i18n->name }}
                                        </label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
        @isset($hint)
            <small class="form-text text-muted">{{ $hint }}</small>
        @endisset
    </div>
</div>

@if (isset($line) && $line)
    <div class="ln_solid"></div>
@endif

@push('js-init')
    <script>
        $(document).ready(function() {
            // Select parent checkboxes
            $('input[id^="parent_"]').on('click', function() {
                var isChecked = $(this).is(':checked');

                // Toggle child categories visibility
                $(this).closest('li').find('.child-category').toggle(isChecked);

                // If parent is unchecked, uncheck all child checkboxes
                if (!isChecked) {
                    $(this).closest('li').find('input[id^="child_"]').prop('checked', false);
                }
            });

            // Select child checkboxes
            $('input[id^="child_"]').on('click', function() {
                var isChecked = $(this).is(':checked');
                // If checked, check the parent checkbox
                if (isChecked) {
                    $(this).parents('li').find('input[id^="parent_"]').first().prop('checked', true);
                }
                // If unchecked and no other siblings are checked, uncheck the parent checkbox
                else if ($(this).closest('ul').find('input[id^="child_"]:checked').length === 0) {
                    $(this).parents('ul').closest('li').find('input[id^="parent_"]').first().prop('checked', false);
                }
            });
        });
    </script>
@endpush
