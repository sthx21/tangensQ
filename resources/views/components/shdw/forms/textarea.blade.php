
@props(['disabled' => false])


<div class="form-floating">
<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring infiniteScroll
focus:ring-indigo-200 focus:ring-opacity-50 w-full',
'style' => 'height: 200px',

'placeholder' => $label,
'id' => $name,
$lazy => $name,
'value' => $value,
'rows'  => $rows,
'cols' => $cols,
]) !!} wire:model="{{ $name }}">
    {{$slot}}
</textarea>
<label for="{{ $name }}">{{ $label }}</label>
</div>
