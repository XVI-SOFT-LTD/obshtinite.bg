<?php
if (isset($value)) {
    $checked = $value == 1 ? 'checked' : null;
}
?>

<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" @isset($id) for="{{ $id }}" @endisset>
        {{ $label }}
        @if (isset($required) && $required)
            <span class="required">*</span>
        @endif
    </label>
    <div class="col-md-7 col-sm-7 col-xs-12 checkbox">
        {{ Form::hidden($name, 0) }}
        <input type="checkbox" class="js-switch form-control col-md-7 col-xs-12" name="{{ $name }}" @isset($id) id="{{ $id }}" @endisset
            @if (isset($disabled) && $disabled) disabled="{{ $disabled }}" @endif @if (isset($required) && $required) required="required" @endif value="1"
            @if (isset($checked) && $checked) checked @endif>
        @isset($hint)
            <div class="clearfix"></div>
            <small class="form-text text-muted">{{ $hint }}</small>
        @endisset
    </div>
</div>

@if (isset($line) && $line)
    <div class="ln_solid"></div>
@endif
