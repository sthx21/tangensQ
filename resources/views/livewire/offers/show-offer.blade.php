<div>
    <div class="row">
        <div class="tabset col-md-9 col-12">
            <!-- Tab 1 -->
            <input type="radio" name="tabset" id="tab1" aria-controls="general" checked>
            <label for="tab1">Allgemein</label>
            <input type="radio" name="tabset" id="tab2" aria-controls="attachments">
            <label for="tab2">Anhänge</label>
            <div class="tab-panels">
                <section id="general" class="tab-panel">
                    <div class="container">
                        <div class="card">
                            <div class="card-header">
                                <div class="row d-flex justify-content-between pb-20">
                                    <div class="col-md-6">
                                        <h4 style="font-weight: bold"> Angebot für: {{$offer->companies->first()->name ?? ''}}</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <h4 style="font-weight: bold"> Title: {{$offer->title ?? ''}}</h4>
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-center pb-10">
                                    <div>
                                    </div>
                                </div>
                                <div class="row pb-10">
                                    <table class="table-bordered">
                                        <tr>
                                            <th>Erstellt von:</th>
                                            <th>Status</th>
                                            <th>Angebotstyp:</th>
                                        </tr>
                                        <tr style="margin-bottom: 30px; padding-bottom: 50px">
                                            <td>{{$author->first_name}}</td>
                                            <td>{{$offer->status}}</td>
                                            <td>{{$offer->type}}</td>
                                        </tr>
                                        <tr>
                                            <th>Zieldatum:</th>
                                            <th>Ablaufdatum:</th>
                                            <th>Entscheidungsdatum:</th>
                                        </tr>
                                        <tr>
                                            <td>{{$offer->target_date}}</td>
                                            <td>{{$offer->due_date}}</td>
                                            <td>{{$offer->completion_date}}</td>
                                        </tr>
                                        <tr>
                                            <th>Wert:</th>
                                            <th>Rabatt:</th>
                                            <th>Total:</th>
                                        </tr>
                                        <tr>
                                            <td>{{$offer->amount}}</td>
                                            <td>{{$offer->discount}}</td>
                                            <td>{{$offer->total}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row pb-20">
                                    <table class="table">
                                        <tr>
                                            <th><h5>Teilnehmer:</h5></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        @foreach($staffMembers as $staff)
                                            <tr style="margin-bottom: 30px; padding-bottom: 50px">
                                                <td>{{$staff['first_name']}}</td>
                                                <td>{{$staff['last_name']}}</td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                        @foreach($clientMembers as $client)
                                            <tr style="margin-bottom: 30px; padding-bottom: 50px">
                                                <td>{{$client['first_name']}}</td>
                                                <td>{{$client['last_name']}}</td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="w-full">
                                    <textarea class="w-100" style="height: fit-content; min-height: 200px">{{$offer->about}}</textarea>
                                </div>
                                <div class="col-12">
                                    <table class="table table-bordered" id="series">
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        @if (count($events) > 0)
                                            <tr>
                                                <th>{{trans('workshops.forms.trainer')}}</th>
                                                <th>{{trans('workshops.forms.date')}}</th>
                                                <th>{{trans('workshops.forms.time')}}</th>
                                                <th>{{trans('workshops.forms.location')}}</th>
                                            </tr>
                                            @foreach ($events as $key => $event)
                                                <tr id="attrRow0" class="dynamic-attributes">
                                                    <td>
                                                        <x-shdw-select class="form-control w-100 small"
                                                                       name="events.{{$key}}.first_trainer" label="Trainer"
                                                                       wire:key="events.{{$key}}.first_trainer" disabled="">
                                                            <option selected></option>
                                                            @foreach($trainers as $trainer)
                                                                <option value="{{ $trainer->id  }}"
                                                                        wire:key="events.trainer_trainer.{{$key}}">{{$trainer->last_name}}</option>
                                                            @endforeach
                                                        </x-shdw-select>
                                                        <x-shdw-select class="form-control w-100 small"
                                                                       name="events.{{$key}}.second_trainer" label="Trainer"
                                                                       wire:key="events.{{$key}}.second_trainer" disabled="">
                                                            <option selected></option>
                                                            @foreach($trainers as $trainer)
                                                                <option value="{{ $trainer->id  }}"
                                                                        wire:key="events.second_trainer.{{$key}}">{{$trainer->last_name}}</option>
                                                            @endforeach
                                                        </x-shdw-select>
                                                    </td>
                                                    <td>
                                                        <x-shdw-input type="date" name="events.{{$key}}.start_date" label="Anfangsdatum"
                                                                      class="form-control w-full" wire:key="events.{{$key}}.start_date"
                                                                      disabled=""/>
                                                        <x-shdw-input type="date" name="events.{{$key}}.end_date" label="Enddatum"
                                                                      class="form-control w-full" wire:key="events.{{$key}}.end_date"
                                                                      disabled=""/>
                                                    </td>
                                                    <td>
                                                        <x-shdw-input type="time" name="events.{{$key}}.start_time" label="Anfangszeit"
                                                                      class="form-control w-full" wire:key="events.{{$key}}.start_time"
                                                                      disabled=""/>
                                                        <x-shdw-input type="time" name="events.{{$key}}.end_time" label="Endzeit"
                                                                      class="form-control w-full" wire:key="events.{{$key}}.end_time"
                                                                      disabled=""/>
                                                    </td>
                                                    <td>
                                                        <x-shdw-input type="text" name="events.{{$key}}.location" label="Location"
                                                                      class="form-control w-full" wire:key="events.{{$key}}.location"
                                                                      disabled=""/>
                                                    </td>
                                                    <td>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="attachments" class="tab-panel">
                    <table class="table-bordered" style="width: 100%">
                        <tr>
                            <th>
                            Dateiname:
                            </th>
                            <th>
                            Uploaddatum:
                            </th>
                            <th>
                            Optionen:
                            </th>
                        </tr>
                        @foreach($uploadedPdfs as $pdf)
                            <tr>
                        <td>{{$pdf->file_name}}</td>
                        <td>{{$pdf->created_at}}</td>
                        <td> <livewire:helpers.download-button :fileId="$pdf->id"/></td>
                            </tr>
                        @endforeach
                    </table>
                </section>
            </div>
        </div>

    <div class="col-md-3">
        <div class="buttonMenu mr-md-4 mb-md-4 pr-md-4" >
            <a href="/Angebote/{{$offer->slug}}/edit"> <button class="editButton">Bearbeiten</button></a>
            <a href="/Angebote/"> <button class="backToButton" name="backToButton">Angebotsübersicht</button></a>
        </div>
        @include('livewire.partials.show-activities')
    </div>
    </div>
</div>



