<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" @isset($id) for="{{ $id }}" @endisset>
        {{ $label }}
        @if (isset($required) && $required)
            <span class="required">*</span>
        @endif
    </label>
    <div class="col-md-9 col-sm-9 col-xs-12">
        <select id="{{ $id }}" name="{{ $name }}{{ isset($multiple) && $multiple ? '[]' : '' }}" class="form-control" @if(isset($multiple) && $multiple) multiple="multiple" @endif>
            <option value="">{{ $placeholder }}</option>
            @foreach ($items as $item)
                @php
                    $selectedItems = isset($selected) && (is_array($selected) ? in_array($item->id, $selected) : $item->id == $selected);
                @endphp
                <option value="{{ $item->id }}" @if ((old($name) && (is_array(old($name)) ? in_array($item->id, old($name)) : old($name) == $item->id)) || $selectedItems) selected @endif>{{ $item->i18n->name }}</option>
            @endforeach
        </select>
        @isset($hint)
            <small class="form-text text-muted">{{ $hint }}</small>
        @endisset
    </div>
</div>

@if (isset($line) && $line)
    <div class="ln_solid"></div>
@endif

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#' + `{{ $id }}`).select2({
                placeholder: `{{ $placeholder }}`,
                allowClear: true
            });
        });
    </script>
@endpush