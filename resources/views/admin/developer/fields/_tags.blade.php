<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" @isset($id) for="{{ $id }}" @endisset>
        {{ $label }}
        @if (isset($required) && $required)
            <span class="required">*</span>
        @endif
    </label>
    <div class="col-md-9 col-sm-9 col-xs-12">
        <input type="text" class="tagsinput form-control col-md-12 col-xs-12" name="{{ $name }}" value="{{ $value ?? null }}" />
        <div id="suggestions-container" style="position: relative; float: left; width: 100%а; margin: 10px;"></div>
        @isset($hint)
            <small class="form-text text-muted">{{ $hint }}</small>
        @endisset
    </div>
</div>

@push('js-init')
    <script>
        $(document).ready(function() {
            $('.tagsinput').tagsInput({
                trimValue: true,
                allowDuplicates: false,
                cancelConfirmKeysOnEmpty: true,
                freeInput: true,
                defaultText: '{{ $placeholder }}'
            });
        });
    </script>
@endpush
