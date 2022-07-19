<div>
<div class="row">

    <div class="buttonMenu mr-md-4 mb-md-4 pr-md-4" >

        <a href="/Angebote/{{$offer->slug}}"> <button class="editButton">Details</button></a>
        <a href="/Angebote/"> <button class="backToButton" name="backToButton">Angebotsübersicht</button></a>
    </div>
</div>
        <div class="container">
                <div class="card">
                    <div class="card-header" >
                        <div class="row d-flex justify-content-between">
                            <div class="col-md-4">
                                <h4 style="font-weight: bold"> Angebot für: {{$recipientName}}</h4>

                            </div>
                            <div class="col-md-4">

                            </div>
                        </div>
                        <form wire:submit.prevent="uploadPdf">
                            <input type="file" wire:model="pdfUpload">
                            <button type="submit">PDF anhängen</button>
                        </form>
                          <div class="row">
                              <div class="col-md-3 col-12">
                                  <x-shdw-input name="groupDiscount" label="Rabatt der Unternehmensgruppe" disabled=""/>
                              </div>
                              <div class="col-md-3 col-12">
                                  <x-shdw-input name="companyDiscount" label="Rabatt des Unternehmens" disabled=""/>
                              </div>
                              <div class="col-md-2 col-12">
                                  <x-shdw-input name="author.first_name" label="Erstellt von" disabled=""/>
                              </div>
                              <div class="col-md-2 col-12">
                                  <x-shdw-select name="offer.status" label="Status">
                                      <option value="">Bitte wählen..</option>
                                      @foreach ($status as $st)
                                          <option value="{{$st}}">{{$st}}</option>
                                      @endforeach
                                  </x-shdw-select>
                              </div>
                              <div class="col-md-2">
                                  @if ($offer->isDirty())
                                      <button class="storeButton" name="storeButton" wire:click.prevent="update()">{{trans('accounting.buttons.update')}}</button>
                                  @endif
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-6 col-12 mt-8">
                                  <x-shdw-input name="selectClient" lazy="true" label="Teilnehmer hinzufügen"/>
                                  @if ($peopleResults)
                                      <ul class="searchResults">
                                          @if ($peopleResults->staff)
                                              <li style="font-weight: bold; text-align: center" disabled="">HR Mitarbeiter</li>
                                              <li style="font-weight: bold; text-align: center">.....</li>
                                          @foreach($peopleResults->staff as $staff)
                                              <li wire:click.prevent="addClient('staff', {{$staff->id}})" wire:key="staff.{{$staff->id}}">
                                                  {{ $staff->last_name.', '.$staff->first_name.' | '.$staff->company->name }}
                                              </li>
                                          @endforeach
                                          @endif
                                          <li class="dividerLine"></li>

                                              @if ($peopleResults->clients)
                                                  <li style="font-weight: bold; text-align: center">TN Mitarbeiter</li>
                                                  <li style="font-weight: bold; text-align: center">.....</li>
                                                  @foreach($peopleResults->clients as $client)
                                                      <li wire:click.prevent="addClient('client', {{$client->id}})" wire:key="staff.{{$client->id}}">
                                                          {{ $client->last_name.', '.$client->first_name.' | '.$client->company->name }}
                                                      </li>
                                                  @endforeach
                                              @endif

                                      </ul>
                                  @endif
                              </div>
                              <div class="col-md-6 col-12">
                                  <div class="addedItemsBox">
                                      @if ($offer->staffMembers)
                                          @foreach ($offer->staffMembers as $addedStaffMember)
                                              <div class="addedTag" wire:click.prevent="removeClient('staff', {{$addedStaffMember['id']}})">
                                                  {{$addedStaffMember['first_name'].' '.$addedStaffMember['last_name']}}
                                              </div>
                                          @endforeach
                                      @endif
                                     @if ($offer->clientMembers)
                                              @foreach ($offer->clientMembers as $key => $addedClient)
                                                  <div class="addedTag" wire:click.prevent="removeClient('client', {{$key}})" wire:key="removeClient.{{$key}}">
                                                      {{$addedClient['first_name'].' '.$addedClient['last_name']}}<br>
                                                  </div>
                                              @endforeach
                                     @endif

                                  </div>
                              </div>
                          </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <x-shdw-input name="offer.title" label="Titel"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-12">
                                <x-shdw-input type="date" name="offer.target_date" label="Zieldatum"/>
                            </div>
                            <div class="col-md-4 col-12">
                                <x-shdw-input  type="date" name="offer.valid_until" label="Ablaufdatum"/>
                            </div>
                            <div class="col-md-4 col-12">
                                <x-shdw-input  type="date" name="offer.due_date" label="Zusagedatum"/>
                            </div>
                        </div>
                            <div class="row d-flex justify-content-between">
                                <div class="col-md-3 col-12">
                                    <x-shdw-select name="offer.type" label="Art">
                                        <option value="" selected>Bitte wählen</option>
                                        @foreach ($types as $type)
                                            <option value="{{$type}}">{{$type}}</option>
                                        @endforeach
                                    </x-shdw-select>
                                </div>

                                <div class="col-md-6 col-12 d-flex">


                                    <div class="col-md-4 col-12">
                                    <x-shdw-input name="offer.amount" label="Wert"/>
                                </div>
                                <div class="col-md-2 col-12">
                                    <x-shdw-input name="offer.discount" label="Rabatt"/>
                                </div>
                                <div class="col-md-4 col-12">
                                    <x-shdw-input name="total" label="Total" disabled=""/>
                                </div>
                            </div>
                            </div>

                        <x-shdw-textarea class="w-full" rows="10" name="offer.about" label="Text" wire:model="offer.about"/>
                        <div class="col-12">
                            <table class="table table-bordered" id="series">
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>@if ($newEvent)
                                            <button class="storeButton" name="storeButton" wire:click.prevent="update()">{{trans('accounting.buttons.update')}}</button>
                                        @endif</th>
                                    <th>
                                        @if (count($events) < 1)
                                            Event hinzufügen:
                                        @endif
                                        @if (count($events) > 0)
                                            Weiteres Event:
                                        @endif
                                    </th>
                                    <th><button type="button" wire:click.prevent="addEvent()" name="addTopic" id="addTopic" class="btn btn-success">+</button></th>
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
                                                <x-shdw-select  class="form-control w-100 small" name="events.{{$key}}.first_trainer" label="Trainer" wire:key="events.{{$key}}.first_trainer">
                                                    <option selected></option>
                                                    @foreach($trainers as $trainer)
                                                        <option value="{{ $trainer->id  }}" wire:key="events.trainer_trainer.{{$key}}">{{$trainer->last_name}}</option>
                                                    @endforeach
                                                </x-shdw-select>
                                                <x-shdw-select  class="form-control w-100 small" name="events.{{$key}}.second_trainer" label="Trainer" wire:key="events.{{$key}}.second_trainer">
                                                    <option selected></option>
                                                    @foreach($trainers as $trainer)
                                                        <option value="{{ $trainer->id  }}" wire:key="events.second_trainer.{{$key}}">{{$trainer->last_name}}</option>
                                                    @endforeach
                                                </x-shdw-select>
                                            </td>
                                            <td>
                                                <x-shdw-input type="date" name="events.{{$key}}.start_date"  label="Anfangsdatum" class="form-control w-full" wire:key="events.{{$key}}.start_date" />
                                                <x-shdw-input type="date" name="events.{{$key}}.end_date"  label="Enddatum" class="form-control w-full" wire:key="events.{{$key}}.end_date" />
                                            </td>
                                            <td>
                                                <x-shdw-input type="time" name="events.{{$key}}.start_time"  label="Anfangszeit" class="form-control w-full" wire:key="events.{{$key}}.start_time"/>
                                                <x-shdw-input type="time" name="events.{{$key}}.end_time"  label="Endzeit" class="form-control w-full" wire:key="events.{{$key}}.end_time"/>
                                            </td>
                                            <td>
                                                <x-shdw-input type="text" name="events.{{$key}}.location" label="Location" class="form-control w-full" wire:key="events.{{$key}}.location" />
                                            </td>
                                            <td>

                                                <button type="button" name="remove" class="btn btn-danger" wire:click.prevent="removeEvent({{$key}})" wire:key="removeEvent.{{$key}}">X</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </table>
                        </div>
                    </div>
            </div>
        </div>

        </div>



