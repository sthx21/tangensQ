
<div>
    <div class="container">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        {{trans('workshops.general.editWorkshop')}}
                        <div class="pull-right">
                            @if ($workshop->isDirty())
                                <button type="button" name="store" class="editButton" wire:click.prevent="update()">{{trans('workshops.buttons.save')}}</button>

                            @endif
                                <button class="backToButton" name="backToButton"
                                        wire:click.prevent="backToWorkshops()">{{trans('workshops.buttons.backToWorkshops')}}</button>
                                <button class="detailsButton" wire:click.prevent="showWorkshop({{$workshop}})" wire:key="show.{{$workshop->id}}">{{trans('workshops.buttons.show')}}</button>
                                <button class="removeButton" name="deleteButton"
                                        wire:click.prevent="confirmDelete()">{{trans('workshops.buttons.delete')}}</button>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class=" col-md-6 col-12 pt-3">

                            <x-shdw-input name="workshop.title" label="Titel"/>
                        </div>
                        <div class=" col-md-6 col-12 pt-3">
                            <x-shdw-input name="workshop.additional_title" label="Zusatztitel"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 pt-3">
                            <x-shdw-input name="workshop.price" label="Nettopreis"/>
                        </div>

                    </div>
                </div>
                <div class="row mx-2">
                    <div class="col-md-4 col-12 pt-3">
                        <x-shdw-textarea wire:model="workshop.targets" rows="10" name="newWorkshop.targets"  style="width: 100%" placeholder="{{trans('workshops.forms.Targets')}}"/>

                    </div>

                    <div class="col-md-4 col-12 pt-3">
                        <x-shdw-textarea wire:model="workshop.process_flow" rows="10" name="newWorkshop.process_flow" style="width: 100%" placeholder="{{trans('workshops.forms.ProcessFlow')}}"/>
                    </div>
                    <div class="col-md-4 col-12 pt-3">
                        <x-shdw-textarea wire:model="workshop.misc" rows="10" name="misc" style="width: 100%" placeholder="{{trans('workshops.forms.Misc')}}"/>
                    </div>
                </div>


                <div class="row m-2">
                    <div class="col-md-6 col-12 pt-3">
                        <x-shdw-textarea wire:model="workshop.detail" rows="10" style="width: 100%" placeholder="{{trans('workshops.forms.Details')}}"/>
                    </div>
                    <div class="col-6 pt-3">
                        <x-label for="topic_coreQuestions" :value="trans('forms.create_workshop_label_topic_coreQuestions')" />

                        <div class="col-12">
                            <table class="table table-bordered" id="topics">
                                <tr>
                                    <th>{{trans('workshops.edit.addTopicField')}}</th>
                                    <th><button type="button" wire:click.prevent="addTopic()" name="addTopic" id="addTopic" class="btn btn-success">+</button></th>
                                </tr>
                                @if ($workshop->topic_coreQuestions)
                                    @foreach($workshop->topic_coreQuestions as $key => $topic)
                                        <tr>
                                            <td><x-shdw-input name="workshop.topic_coreQuestions.{{$key}}.topic" label="Kernfragen" wire:key="topic.{{$key}}"/></td>
                                            <td><button type="button" name="remove" id="0" class="btn btn-danger" wire:click.prevent="removeTopic({{$key}})" wire:key="removeTopic.{{$key}}">X</button></td>
                                        </tr>
                                    @endforeach
                                @endif

                            </table>

                        </div>

                    </div>
                </div>
                <div class="col-12">
                    <table class="table table-bordered" id="series">
                        <tr>
                            <th>{{trans('workshops.show.trainer')}}</th>
                            <th>{{trans('workshops.show.date')}}</th>
                            <th>{{trans('workshops.show.time')}}</th>
                            <th><label for="location">{{trans('workshops.show.location')}}</label> </th>
                            <th>{{trans('workshops.show.cancellation_date')}}</th>
                        </tr>
                            <tr id="attrRow0" class="dynamic-attributes">
                                <td>
                                    <x-shdw-select  class="form-control w-100 small" name="first_trainer" label="Trainer" wire:key="first_trainer">
                                        @foreach($trainers as $trainer)
                                            <option value="{{ $trainer->id }}" wire:key="trainer-{{ $trainer->id }}" wire:click.prevent="update()">{{ $trainer->last_name }}</option>
                                        @endforeach
                                    </x-shdw-select>
                                    <x-shdw-select  class="form-control w-100 small" name="second_trainer" label="Trainer" wire:key="second_trainer">
                                        @foreach($trainers as $trainer)
                                            <option value="{{ $trainer->id }}" wire:key="sec_trainer-{{ $trainer->id }}"  wire:click.prevent="update()">{{ $trainer->last_name }}</option>
                                        @endforeach
                                    </x-shdw-select>
                                </td>
                                <td>
                                    <x-shdw-input type="date" name="workshop.start_date"  label="Anfangsdatum" class="form-control w-full" wire:key="events.{{$key}}.start_date" />
                                    <x-shdw-input type="date" name="workshop.end_date"  label="Enddatum" class="form-control w-full" wire:key="events.{{$key}}.end_date" />
                                </td>
                                <td>
                                    <x-shdw-input type="time" name="workshop.start_time"  label="Anfangszeit" class="form-control w-full" wire:key="events.{{$key}}.start_time"/>
                                    <x-shdw-input type="time" name="workshop.end_time"  label="Endzeit" class="form-control w-full" wire:key="events.{{$key}}.end_time"/>
                                </td>
                                <td>
                                    <x-shdw-input name="workshop.location" label="Location" class="form-control w-full" wire:key="events.{{$key}}.location" />
                                    <x-shdw-select name="workshop.region" label="Region">
                                        @foreach ($regions as $region)
                                            <option value="{{$region}}">{{$region}}</option>
                                        @endforeach
                                    </x-shdw-select>
                                </td>
                                <td><x-shdw-input type="date" name="workshop.cancellation_date" label="Stornodatum" class="form-control w-full" />
                                    <x-shdw-select name="workshop.status" label="Status">
                                        @foreach ($status as $state)
                                            <option value="{{$state}}">{{$state}}</option>
                                        @endforeach
                                    </x-shdw-select>
                                </td>
                            </tr>
                    </table>
                </div>
                        <div class="row pb-4 pl-2">
                                <div class="col-md-6 col-12 pt-3">
                                    <strong>{{trans('workshops.edit.bookedClients')}}</strong>
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>{{trans('workshops.show.clientName')}}</th>
                                            <th>{{trans('workshops.show.clientFirm')}}</th>
                                            <th>{{trans('clients.general.remove')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($clients as $client)
                                            <tr>
                                                <td>{{$client['first_name']}} {{$client['last_name']}}</td>
                                                <td>{{$client->company->name}}</td>
                                                <td>
                                                    <button type="button" name="removeStaff" class="btn btn-danger" wire:click.prevent="confirmClientRemoval({{$client}})" wire:key="removeStaff.{{$client->id}}">X</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @foreach($staff as $staffMember)
                                            <tr>
                                                <td>{{$staffMember->first_name}} {{$staffMember->last_name}}</td>
                                                <td>{{$staffMember->company->name}}</td>
                                                <td >
                                                    <button type="button" name="removeStaff" class="btn btn-danger" wire:click.prevent="confirmClientRemoval({{$staffMember}})" wire:key="removeStaff.{{$staffMember->id}}">X</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            <div class="col-md-6 col-12 pt-3 pr-2 pb-80">
                                <div class="row">
                                    <div class="col-md-6">
                                        <x-shdw-input name="addClientLastName" label="TN nach Nachname suchen.." class="form-control w-full" />
                                    </div>
                                    <div class="col-md-6">
                                        <x-shdw-input name="addClientFirstName" label="Ergebnis nach Vornamen filtern.." class="form-control w-full" />
                                    </div>
                                </div>


                                <div>
                                    @if ($clientResults['staff'])
                                        <ul class="searchResults">
                                            @foreach($clientResults['staff'] as $staffResult)
                                                <li wire:click.prevent="addStaff({{$staffResult}})">{{ $staffResult->last_name.', '. $staffResult->first_name.'   |   '.$staffResult->company->name }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                                <div>
                                    @if ($clientResults['clients'])
                                        <ul class="searchResults">
                                            @foreach($clientResults['clients'] as $clientResult)
                                                <li wire:click.prevent="addClient({{$clientResult}})">{{ $clientResult->last_name.', '. $clientResult->first_name.'   |   '.$clientResult->company->name }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
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
        window.addEventListener('confirmClientRemove',event =>{
            Swal.fire({
                title: event.detail.title,
                text: "Bist du sicher..?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ich bin sicher!',
                cancelButtonText: 'Whoops..'
            })
                .then((result) => {
                        if (result.value){
                        @this.call('removeClient', event.detail.id)
                        }
                    }

                )
        });
    </script>
        </div>

