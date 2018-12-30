@php
    $inputSize = isset($inputSize) ? '-'.$inputSize : '-12';
    $items = isset($items) ? $items : false;
    $disabled = isset($disabled) ? $disabled : false;
    $autofocus = isset($autofocus) ? $autofocus : false;
    $required = isset($required) ? $required : false;
    $css = isset($css) ? $css : '';
    $sideBySide = isset($sideBySide) ? $sideBySide : false;
    $dateTimeFormat = isset($dateTimeFormat) ? $dateTimeFormat : false;
    $picker_begin = isset($picker_begin) ? $picker_begin : '';
    $picker_end = isset($picker_end) ? $picker_end : '';
    $readOnly = isset($readOnly) ? $readOnly : false;
@endphp
<div class="col col-sm col-md{{$inputSize}} col-lg{{$inputSize}} {{ $errors->has($field) ? ' has-error' : '' }}">
    @if(isset($label))
        @component('components.label', ['label' => $label, 'field' => $field, 'required' => $required])
        @endcomponent
    @endif  
    
    <div class="input-group date" id="{{$id}}_picker">
        <input type="text" class="form-control {{$css}}" name="{{$name}}" id="{{$id}}" value="{{ isset($inputValue) ? $inputValue : old($field) }}" {{ $required ? 'required' : '' }}  {{ $autofocus ? 'autofocus' : '' }} {{ $disabled ? 'disabled="disabled"' : '' }} {{ $readOnly ? 'readonly' : '' }}>
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
        </span>
    </div>

    @if ($errors->has($field))
        <span class="help-block">
            <strong>{{ $errors->first($field) }}</strong>
        </span>
    @endif
</div>
@push('bottom-scripts')
<script type="text/javascript">
    $(function () {
        $('#{{$id}}_picker').datetimepicker({
            {{ $sideBySide ? 'sideBySide: true, ' : '' }}
            format : "{{ $dateTimeFormat ? $dateTimeFormat : 'DD/MM/YYYY HH:mm' }}",
            {{ ($picker_end == $id) ? 'useCurrent: false' : '' }}

        });
        $('#{{$id}}_picker').val('{{ isset($inputValue) ? $inputValue : old($field) }}');
        @if($picker_begin == $id) 
            $("#{{$picker_begin}}_picker").on("dp.change", function (e) {
                $('#{{$picker_end}}_picker').data("DateTimePicker").minDate(e.date);
            });
        @endif
        @if($picker_end == $id) 
            $("#{{$picker_end}}_picker").on("dp.change", function (e) {
                $('#{{$picker_begin}}_picker').data("DateTimePicker").maxDate(e.date);
            });
        @endif
    });
</script>
@endpush