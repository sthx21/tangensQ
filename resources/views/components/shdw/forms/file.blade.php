{{--@props(['value' => ''])--}}

<div class="">
        <input type="file"
               {{$lazy}} ="{{$name}}"
               wire:model="{{ $name }}"
               value="{{$value}}" class="form-control block mt-1 w-full" id="{{ $name }}"
               placeholder="{{ $label }}" multiple>
    @error($name) <span class="error">{{ $message }}</span> @enderror

</div>




