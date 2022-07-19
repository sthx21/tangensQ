<div class="col-12">
    <div class="card">

        <div class="card-header d-sm-flex flex-sm-row">
            <div class="pb-sm-4 pl-md-2">
                <h4> {!! trans('staff.editingStaff', ['name' => $staff->last_name]) !!}</h4>
            </div>
            <div class="buttonMenu">
                @if ($newLogo)
                    <button class="editButton" name="editButton"
                            wire:click.prevent="update()">{{trans('staff.buttons.saveChanges')}}</button>
                @endif
                @if ($staff->isDirty() && !$newLogo)
                    <button class="editButton" name="editButton"
                            wire:click.prevent="update()">{{trans('staff.buttons.saveChanges')}}</button>
                @endif


                <button class="backToButton" name="backToButton"
                        wire:click.prevent="backToStaff()">{{trans('staff.buttons.backToStaff')}}</button>
                    <button class="editButton" name="transfer"
                            wire:click.prevent="confirmTransferToClients()"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="{{trans('staff.tooltips.transfer')}}">{{trans('staff.buttons.transfer')}}</button>
                <button class="removeButton" name="deleteButton"
                        wire:click.prevent="destroy()">{{trans('staff.buttons.delete')}}</button>
            </div>
        </div>
        <div class="card-body pl-2">
            <div class="row text-center text-left-tablet mb-4">
                <div class="col-12 col-md-4">
                    <div>
                        <x-shdw-file name="newLogo" label="Neues Logo"/>
                    </div>
                    @if ($staff->hasMedia('staffLogo') && !isset($newLogo))
                        <img src="{{$staff->getFirstMediaUrl('staffLogo')}}" alt=""
                             class="center-block w-100 border-1">
                    @endif
                    @if ($newLogo)
                        <img src="{{ $newLogo[0]->temporaryUrl() }}" alt="Logo">
                    @endif

                </div>

                <div class="col-12 col-md-4">
                    <x-shdw-select name="staff.title" :label="trans('staff.forms.title_label')">
                        <option selected>{{$staff->title}}</option>
                        @foreach ($titles as $key => $value)
                            <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </x-shdw-select>
                    <x-shdw-input name="staff.first_name" label="Name"/>
                    <x-shdw-input name="staff.last_name" label="Name"/>
                    <x-shdw-input name="staff.additional_address" label="Adresszusatz"/>
                    <div class="row">
                        <div class="col-8">
                            <x-shdw-input name="staff.street" label="Straße"/>
                        </div>
                        <div class="col-4">
                            <x-shdw-input name="staff.house_number" label="Nr."/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <x-shdw-input name="staff.zip" label="PLZ"/>
                        </div>
                        <div class="col-8">
                            <x-shdw-input name="staff.city" label="Stadt/Ort"/>
                        </div>
                    </div>
                    <x-shdw-input name="staff.homepage" label="Homepage"/>
                    <x-shdw-input name="staff.email" label="Email"/>
                    <x-shdw-input name="staff.second_email" label="Zweitemail"/>
                    <x-shdw-input name="staff.phone" label="Telefon"/>
                    <x-shdw-input name="staff.second_phone" label="Zweittelefon"/>
                    <x-shdw-input name="staff.info" label="Info"/>
                </div>
                <div class="col-12 col-md-4">
                    @include('livewire.staff.partials.edit-staff-tags')
                </div>
            </div>
        </div>
    </div>
</div>
