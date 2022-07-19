<div>
    <style>
        .module {
            background-color: lightseagreen;
            font-family: 'Font Awesome 5 Pro', 'Font Awesome 5 Free', sans-serif;
            font-weight: bold;
            font-size: medium;
            padding: 8px;
        }
    </style>
    <div class="container">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {{trans('workshops.general.newWorkshop')}}
                            <div class="pull-right">
                                <a href="{{ route('workshops') }}" class="btn btn-warning btn-sm float-right" data-toggle="tooltip" data-placement="top" title="{{ trans('workshops.tooltips.back-workshops') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    {{trans('workshops.buttons.cancel')}}
                                </a>

                            </div>
                        </div>
                    </div>
                <div class="card-body">
                    <div class="row">
                    <div class=" col-md-6 col-12 pt-3">

                        <x-shdw-input name="newWorkshop.title" :label="trans('workshops.forms.workshop_title')"/>
                    </div>
                        <div class=" col-md-6 col-12 pt-3">
                            <x-shdw-input name="newWorkshop.additional_title" :label="trans('workshops.forms.workshop_additional_title')"/>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-4 pt-3">
                            <x-shdw-input name="newWorkshop.price" :label="trans('workshops.forms.price')"/>
                        </div>

                    </div>
                </div>
                    <div class="row mx-2">
                        <div class="col-md-4 col-12 pt-3">
                            <x-shdw-textarea wire:model="newWorkshop.targets" rows="10" name="newWorkshop.targets"  style="width: 100%" placeholder="{{trans('workshops.forms.Targets')}}"/>

                        </div>

                        <div class="col-md-4 col-12 pt-3">
                            <x-shdw-textarea wire:model="newWorkshop.process_flow" rows="10" name="newWorkshop.process_flow" style="width: 100%" placeholder="{{trans('workshops.forms.ProcessFlow')}}"/>
                        </div>
                        <div class="col-md-4 col-12 pt-3">
                            <x-shdw-textarea wire:model="newWorkshop.misc" rows="10" name="misc" style="width: 100%" placeholder="{{trans('workshops.forms.Misc')}}"/>
                        </div>
                    </div>


                        <div class="row m-2">
                    <div class="col-md-6 col-12 pt-3">
                        <x-shdw-textarea wire:model="newWorkshop.detail" rows="10" style="width: 100%" placeholder="{{trans('workshops.forms.Details')}}"/>
                    </div>
                            <div class="col-6 pt-3">
                                <x-label for="topic_coreQuestions" :value="trans('forms.create_workshop_label_topic_coreQuestions')" />

                                <div class="col-12">
                                    <table class="table table-bordered" id="topics">
                                      <tr>
                                            <th>{{trans('workshops.edit.addTopicField')}}</th>
                                            <th><button type="button" wire:click.prevent="addTopic()" name="addTopic" id="addTopic" class="btn btn-success">+</button></th>
                                        </tr>
                                        @foreach($topic_coreQuestions as $key => $topic)
                                            <tr>
                                                <td><x-shdw-input name="topic_coreQuestions.{{$key}}.topic" label="Kernfragen" wire:key="topic_coreQuestions.{{$key}}"/></td>
                                                <td><button type="button" name="remove" id="0" class="btn btn-danger" wire:click.prevent="removeTopic({{$key}})" wire:key="removeTopic.{{$key}}">X</button></td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                    </div>
                    {{--                    Choose Multiple Dates--}}

                        <div class="col-12">
                            <table class="table table-bordered" id="series">
                                <tr>
                                    <th></th>
                                    <th><x-shdw-select  class="form-control w-100 small" name="module" label="Modul?" wire:key="followUp">
                                            <option value="false" selected>Nein</option>
                                            <option value="true">Ja</option>
                                        </x-shdw-select></th>
                                    <th> </th>
                                    <th>Weiteres Seminar:</th>
                                    <th><button type="button" wire:click.prevent="addEvent()" name="addTopic" id="addTopic" class="btn btn-success">+</button></th>
                                </tr>
                                @if ($module)
                                    <span class="module"> Bitte wähle 2 Termine, diese werden verknüpft und die Titel bekommen den Zusatz "Teil - 1" bzw. "Teil - 2".</span>
                                @endif
                                <tr>
                                    <th>{{trans('workshops.forms.trainer')}}</th>
                                    <th>{{trans('workshops.forms.date')}}</th>
                                    <th>{{trans('workshops.forms.time')}}</th>
                                    <th><label for="location">{{trans('workshops.forms.location')}}</label> </th>
                                    <th>{{trans('workshops.forms.cancelDays')}}</th>
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
                                            <x-shdw-select name="events.{{$key}}.region" label="Region">
                                                <option value="">Wähle:</option>
                                                @foreach ($regions as  $region)
                                                    <option value="{{$region}}">{{$region}}</option>
                                                @endforeach
                                            </x-shdw-select>
                                        </td>
                                        <td>
                                            <x-shdw-select class="form-control w-full" name="events.{{$key}}.cancel_days" label="Stornofrist">
                                                <option value="">wähle</option>

                                                <option value="7" wire:key="events.{{$key}}.cancel_days">7 Tage</option>
                                                <option value="14" wire:key="events.{{$key}}.cancel_days">14 Tage</option>
                                                <option value="28" wire:key="events.{{$key}}.cancel_days">28 Tage</option>
                                                <option value="30" wire:key="events.{{$key}}.cancel_days">30 Tage</option>

                                                <option value="42" wire:key="events.{{$key}}.cancel_days">42 Tage</option>
                                                <option value="56" wire:key="events.{{$key}}.cancel_days">56 Tage</option>
                                                <option value="84" wire:key="events.{{$key}}.cancel_days">84 Tage</option>
                                                <option value="112" wire:key="events.{{$key}}.cancel_days">112 Tage</option>
                                            </x-shdw-select>
                                            <button type="button" name="remove" class="btn btn-danger" wire:click.prevent="removeEvent({{$key}})" wire:key="removeEvent.{{$key}}">X</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                </div>

</div>
                    <div class="row pt-3  pl-3 pr-3 pb-2">
                        <div class="col-12 d-grid gap-2">
                            <button type="button" name="store" class="btn btn-success" wire:click.prevent="store()" wire:key="createEvent.{{$key}}">Erstellen</button>
                    </div>
                    </div>
                </div>
            </div>
