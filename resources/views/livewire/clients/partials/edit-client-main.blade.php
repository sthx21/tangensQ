<div class="col-12">
    <div class="card">

        <div class="card-header d-sm-flex flex-sm-row">
            <div class="pb-sm-4 pl-md-2">
                <h4> {!! trans('clients.editing-client', ['name' => $client->last_name]) !!}</h4>
            </div>
            <div class="buttonMenu">
                @if ($newLogo)
                    <button class="editButton" name="editButton"
                            wire:click.prevent="update()">{{trans('clients.buttons.saveChanges')}}</button>
                @endif
                @if ($client->isDirty() && !$newLogo)
                    <button class="editButton" name="editButton"
                            wire:click.prevent="update()">{{trans('clients.buttons.saveChanges')}}</button>
                @endif


                <button class="backToButton" name="backToButton"
                        wire:click.prevent="backToClients()">{{trans('clients.buttons.backToClients')}}</button>
                <button class="removeButton" name="deleteButton"
                        wire:click.prevent="destroy()">{{trans('clients.buttons.delete')}}</button>
            </div>
        </div>
        <div class="card-body pl-2">
            <div class="row text-center text-left-tablet mb-4">
                <div class="col-12 col-md-4">


                </div>

                <div class="col-12 col-md-6">
                    <x-shdw-select name="client.title" :label="trans('clients.forms.title_label')">
                        <option selected>{{$client->title}}</option>
                        @foreach ($titles as $key => $value)
                            <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </x-shdw-select>
                    <x-shdw-input name="client.first_name" label="Name"/>
                    <x-shdw-input name="client.last_name" label="Name"/>
                    <x-shdw-input name="client.additional_address" label="Adresszusatz"/>
                    <div class="row">
                        <div class="col-8">
                            <x-shdw-input name="client.street" label="Straße"/>
                        </div>
                        <div class="col-4">
                            <x-shdw-input name="client.house_number" label="Nr."/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <x-shdw-input name="client.zip" label="PLZ"/>
                        </div>
                        <div class="col-8">
                            <x-shdw-input name="client.city" label="Stadt/Ort"/>
                        </div>
                    </div>
                    <x-shdw-input name="client.homepage" label="Homepage"/>
                    <x-shdw-input name="client.email" label="Email"/>
                    <x-shdw-input name="client.second_email" label="Zweitemail"/>
                    <x-shdw-input name="client.phone" label="Telefon"/>
                    <x-shdw-input name="client.second_phone" label="Zweittelefon"/>
                    <x-shdw-input name="client.info" label="Info"/>
                </div>
                <div class="col-12 col-md-4">
                    @include('livewire.clients.partials.edit-client-tags')
                </div>
            </div>
        </div>
    </div>
</div>
