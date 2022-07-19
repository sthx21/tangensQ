<div class="col-12">
    <div class="card">

        <div class="card-header d-sm-flex flex-sm-row">
            <div class="pb-sm-4 pl-md-2">
                <h4> {!! trans('trainers.editing-trainer', ['name' => $trainer->last_name]) !!}</h4>
            </div>
            <div class="buttonMenu">
                @if ($newLogo)
                    <button class="editButton" name="editButton"
                            wire:click.prevent="update()">{{trans('trainers.buttons.saveChanges')}}</button>
                @endif
                @if ($trainer->isDirty() && !$newLogo)
                    <button class="editButton" name="editButton"
                            wire:click.prevent="update()">{{trans('trainers.buttons.saveChanges')}}</button>
                @endif


                <button class="backToButton" name="backToButton"
                        wire:click.prevent="backToTrainers()">{{trans('trainers.buttons.backToTrainers')}}</button>
                <button class="removeButton" name="deleteButton"
                        wire:click.prevent="confirmDelete()">{{trans('trainers.buttons.delete')}}</button>
            </div>
        </div>
        <div class="card-body pl-2">
            <div class="row text-center text-left-tablet mb-4">
                <div class="col-12 col-md-4">
                    <div>
                        <x-shdw-file name="newLogo" label="Neues Logo"/>
                    </div>
                    @if ($trainer->hasMedia('trainerLogo') && !isset($newLogo))
                        <img src="{{$trainer->getFirstMediaUrl('trainerLogo')}}" alt=""
                             class="center-block w-100 border-1">
                    @endif
                    @if ($newLogo)
                        <img src="{{ $newLogo[0]->temporaryUrl() }}" alt="Logo">
                    @endif

                </div>

                <div class="col-12 col-md-4">
                    <x-shdw-input name="trainer.company_name" label="Firma" />
                    <x-shdw-select name="trainer.title" :label="trans('trainers.forms.title_label')">
                        <option selected>{{$trainer->title}}</option>
                        @foreach ($titles as $key => $value)
                            <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </x-shdw-select>
                    <x-shdw-input name="trainer.first_name" label="Name"/>
                    <x-shdw-input name="trainer.last_name" label="Name"/>
                    <x-shdw-input name="trainer.additional_address" label="Adresszusatz"/>
                    <div class="row">
                        <div class="col-8">
                            <x-shdw-input name="trainer.street" label="Straße"/>
                        </div>
                        <div class="col-4">
                            <x-shdw-input name="trainer.house_number" label="Nr."/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <x-shdw-input name="trainer.zip" label="PLZ"/>
                        </div>
                        <div class="col-8">
                            <x-shdw-input name="trainer.city" label="Stadt/Ort"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <x-shdw-input name="trainer.state" label="Bundesland"/>
                        </div>
                        <div class="col-md-6 col-12">
                            <x-shdw-input name="trainer.country" label="Land"/>
                        </div>
                    </div>
                    <x-shdw-input name="trainer.homepage" label="Homepage"/>
                    <x-shdw-input name="trainer.email" label="Email"/>
                    <x-shdw-input name="trainer.second_email" label="Zweitemail"/>
                    <x-shdw-input name="trainer.phone" label="Telefon"/>
                    <x-shdw-input name="trainer.second_phone" label="Zweittelefon"/>
                        <x-shdw-input name="trainer.coaching_fee_per_hour" :label="trans('trainers.labels.coaching_fee_per_hour')"/>
                        <x-shdw-input name="trainer.training_fee_per_day" :label="trans('trainers.labels.training_fee_per_day')"/>
                        <x-shdw-input name="trainer.consulting_fee_per_day" :label="trans('trainers.labels.consulting_fee_per_day')"/>
                    <x-shdw-input name="trainer.info" label="Info"/>
                </div>
                <div class="col-12 col-md-4">
                    @include('livewire.trainers.partials.edit-trainer-tags')
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('confirmIt',event =>{
            Swal.fire({
                title: event.detail.title,
                text: "Dies kann nicht ungeschehen gemacht werden..!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ich bin sicher!',
                cancelButtonText: 'Whoops..'
            })
                .then((result) => {
                        if (result.value){
                        @this.call('destroy')
                        }
                    }

                )
        });
    </script>
</div>
