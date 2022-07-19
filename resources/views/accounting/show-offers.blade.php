<x-app-layout>
    <x-slot name="header">

        <div class="max-w-full mx-auto sm:px-6 lg:px-8">

            <x-button-link :link="'/accounting/create-offer'" :class="'btn-info'" :title="trans('clients.general.newClient')">{{trans('accounting.general.new')}}</x-button-link>

            {{--            <select class="js-example-basic-single js-states form-control" id="js-example-basic-single" name="js-example-basic-single" />--}}
        </div>

    </x-slot>
<livewire:offers.show-offers/>
</x-app-layout>

