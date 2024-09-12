<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" @isset($id) for="{{ $id }}" @endisset>
        {{ $label }}
        @if (isset($required) && $required)
            <span class="required">*</span>
        @endif
    </label>
    <div class="col-md-7 col-sm-7 col-xs-12">
        <input type="url"
            class="form-control col-md-12 col-xs-12 @isset($class) {{ $class }} @endif" name="{{ $name }}" @isset($id) id="{{ $id }}" @endisset placeholder="{{ $label }}"
            @if (isset($disabled) && $disabled) disabled="{{ $disabled }}" @endif @if (isset($required) && $required) required="required" @endif value="{{ $value ?? null }}"
            @if (isset($readOnly) && $readOnly) readonly @endif>
        @isset($hint)
            <small class="form-text text-muted">{{ $hint }}</small>
        @endisset
    </div>
</div>

@if (isset($line) && $line)
    <div class="ln_solid"></div>
@endif