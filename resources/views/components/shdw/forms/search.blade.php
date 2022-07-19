{{--@props(['value' => '', 'type' => 'text'])--}}

<div class="">
        <input type="{{ $type }}"
               {{$lazy}} ="{{$name}}"
               wire:model="{{ $name }}"
               value="{{$value}}" class="form-control w-full" id="{{ $name }}"
               placeholder="{{ $label }}">

</div>




