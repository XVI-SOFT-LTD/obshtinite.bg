@if (isset($formMode) && $formMode == 'edit' && $object->{$name})
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">
            {{ $text ?? ($label ?? '') }}
        </label>

        <div class="col-md-7 col-sm-7 col-xs-12">
            <div class="img-preview preview-md">
                <img src="{{ asset($dir . $size . $object->{$name}) }}" width="80" />
            </div>
            <div class="form-group form-check mt-2">
                <input type="checkbox" name="delete_{{ $name }}" class="form-check-input mt-0" id="delete_{{ $name }}" value="1">
                <label class="form-check-label" for="delete_{{ $name }}">Изтрий</label>
            </div>
        </div>
    </div>
@endif

<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" @isset($id) for="{{ $id }}" @endisset>

        @if (!isset($object->{$name}))
            {{ $label }}
        @endif

        @if (isset($required) && $required)
            <span class="required">*</span>
        @endif
    </label>
    <div class="col-md-7 col-sm-7 col-xs-12">
        <input type="file"
            class="form-control col-md-12 col-xs-12 @isset($class) {{ $class }} @endif" name="{{ $name }}" @isset($id) id="{{ $id }}" @endisset placeholder="{{ $label }}"
            @if (isset($disabled) && $disabled) disabled="{{ $disabled }}" @endif @if (isset($required) && $required) required="required" @endif value="{{ $value ?? null }}">
        @isset($hint)
            <small class="form-text text-muted">{{ $hint }}</small>
        @endisset
    </div>
</div>

@if (isset($line) && $line)
    <div class="ln_solid"></div>
@endif
