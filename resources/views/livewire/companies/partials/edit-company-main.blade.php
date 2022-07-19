<div class="col-12">
    <div class="card">
        <div class="card-header d-sm-flex flex-sm-row">
            <div class="pb-sm-4 pl-md-2">
                <h4> {!! trans('companies.showingCompanyName', ['name' => $company->name]) !!}</h4>
            </div>
            <div class="buttonMenu">
                @if ($newLogo)
                    <button class="editButton" name="editButton" wire:click.prevent="update()">{{trans('companies.buttons.saveChanges')}}</button>
                @endif
                @if ($company->isDirty() && !$newLogo)
                    <button class="editButton" name="editButton" wire:click.prevent="update()">{{trans('companies.buttons.saveChanges')}}</button>
                @endif


                    <button class="backToButton" name="backToButton" wire:click.prevent="backToCompanies()">{{trans('companies.buttons.backToCompanies')}}</button>
                    <button class="removeButton" name="deleteButton" wire:click.prevent="confirmDelete()">{{trans('companies.buttons.delete')}}</button>
            </div>
        </div>
        <div class="card-body pl-2">
            <div class="row text-center text-left-tablet mb-4">
                <div class="col-3">
                    <div>
                        <x-shdw-file name="newLogo" label="Neues Logo"/>
                    </div>

                @if ($company->hasMedia('companyLogo') && !$newLogo)
                        <img src="{{$company->getFirstMediaUrl('companyLogo')}}" alt="" class="center-block w-100 border-1">
                    @endif
                    @if ($newLogo)
                        <img src="{{ $newLogo[0]->temporaryUrl() }}" alt="Logo">
                    @endif

                </div>
                <div class="col-4">
                    <div class="col-12">
                        <div>
                            <x-shdw-select name="company.managed_by" label="Zuständigkeit">
                                <option value="{{$managed}}">{{$managed}}</option>
                            @foreach ($managed_by as $manager)
                                    <option value="{{$manager}}">{{$manager}}</option>
                                @endforeach


                            </x-shdw-select>
                        </div>
                    </div>
                    <x-shdw-input name="company.name" label="Name"/>
                    <div class="col-12">
                        <x-shdw-input name="company.additional_address" label="Adresszusatz"/>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <x-shdw-input name="company.street" label="Straße"/>
                        </div>
                        <div class="col-4">
                            <x-shdw-input name="company.house_number" label="Nr."/>
                        </div>
                    </div>
                   <div class="row">
                       <div class="col-4">
                           <x-shdw-input name="company.zip" label="PLZ"/>
                       </div>
                       <div class="col-8">
                           <x-shdw-input name="company.city" label="Stadt/Ort"/>
                       </div>
                   </div>
                    <div class="row">
                        <div class="col-6">
                            <x-shdw-input name="company.state" label="Bundesland"/>
                        </div>
                        <div class="col-6">
                            <x-shdw-input name="company.country" label="Land"/>
                        </div>
                    </div>
                    <div>
                        <x-shdw-input name="company.homepage" label="Homepage"/>
                    </div>

                    <div>
                        <x-shdw-input name="company.main_email" label="Email"/>
                    </div>
                    <div>
                        <x-shdw-input name="company.second_email" label="Zweitemail"/>
                    </div>
                    <div>
                        <x-shdw-input name="company.main_phone" label="Telefon"/>
                    </div>
                    <div>
                        <x-shdw-input name="company.second_phone" label="Zweittelefon"/>
                    </div>
                    <div>
                        <x-shdw-input name="company.address_origin" label="Adressherkunft"/>
                    </div>
                    <div>
                        <x-shdw-input name="company.info" label="Info"/>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <x-shdw-input name="company.discount" label="Rabatt:"/>
                        </div>
                        <div class="col-md-6 col-12">
                            <x-shdw-input type="date" name="company.discount_until" label="Rabatt bis:"/>
                        </div>
                    </div>
                    <div>
                        <strong>
                            {{ trans('companies.labels.group') }}
                        </strong>
                    </div>
                    <div>
                        <x-shdw-input name="group.name" label="Unternehmensgruppe" disabled=""/>
                        <x-shdw-input name="addGroup" label="Gruppe ändern.."/>
                        <div>
                            @if ($groupResults)
                                <ul class="searchResults">
                                    <li wire:click.prevent="createGroup()" wire:key="createGroup">Neue Gruppe : {{$addGroup}}</li>
                                    @foreach($groupResults as $groupResult)
                                        <li wire:click.prevent="updateGroup({{$groupResult}})">{{ $groupResult->name }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div>
                        <x-shdw-select name="company.payment_method" label="Bezahlmethode">
                            <option selected class="select">{{$company->payment_method}}</option>
                            <option value="Flatrate">Flatrate</option>
                            <option value="Paket" >Paket</option>
                            <option value="Nachlass" >Nachlass</option>
                            <option value="Preisliste" >Preisliste</option>
                            <option value="ProBono" >ProBono</option>
                        </x-shdw-select>
                    </div>
                </div>
                <div class="col-4">
                    @include('livewire.companies.partials.edit-company-clients')
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
