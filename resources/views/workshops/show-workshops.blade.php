<x-app-layout>
    <x-slot name="header">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8" id="heads">
            <x-button-link :link="'/workshops/create'" :class="'btn-info'" :title="trans('workshops.tooltips.new')">{{trans('workshops.buttons.new')}}</x-button-link>
        </div>
    </x-slot>
<livewire:workshops.show-workshops/>
</x-app-layout>

