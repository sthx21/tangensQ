    <div class="col-12 w-full">

        <div class="ml-8 mr-8 d-flex justify-content-between align-items-center">
            <div>
                @if($workshopFilter === 'future')
                    <strong>{{ trans('companies.labels.workshopActive') }}</strong>
                @endif
                    @if($workshopFilter === 'past')
                        <strong>{{ trans('companies.labels.workshopsHistory') }}</strong>
                    @endif
                    @if($workshopFilter === 'canceled')
                        <strong>{{ trans('companies.labels.canceledWorkshop') }}</strong>
                    @endif
            </div>
        <div class="mb-4">
            <button class="editButton" wire:click.prevent="getWorkshops('all')" name="future">Alle</button>
            <button class="editButton" wire:click.prevent="getWorkshops('future')" name="future">Aktiv</button>
            <button class="editButton" wire:click.prevent="getWorkshops('history')" name="past">Beendet</button>
            <button class="editButton" wire:click.prevent="getWorkshops('canceled')" name="past">Trainer Storno</button>

        </div>

        </div>
        @if (count($workshops) > 0)
            <div class="ml-6 mr-6 mb-12">
                <table class="table table-striped table-sm data-table table-hover" id="trainer_workshops_table">
                    <thead>
                    <tr class="border-black">
                        <th class="tableHeader" wire:click.prevent="sorting('title')">{{ trans('trainers.labels.workshopTitle') }}</th>
                        <th class="tableHeader" wire:click.prevent="sorting('date')">{{ trans('trainers.labels.workshopDate') }}</th>
                        <th class="tableHeader" wire:click.prevent="sorting('location')">{{ trans('trainers.labels.workshopLocation') }}</th>
                        <th class="tableHeader" wire:click.prevent="sorting('clients')">{{ trans('trainers.labels.workshopClients') }}</th>
                        <th class="tableHeader" wire:click.prevent="sorting('canceled')">{{ trans('trainers.labels.workshopCanceled') }}</th>
                        <th class="tableHeader">{{ trans('companies.labels.workshopCanceledBy') }}</th>
                        <th></th>
                    </tr>
                    </thead>
                    @foreach($workshops as $workshop)
                        <tr>
                            <td style="width: max-content">
                                <a href="{{url('workshops/'.$workshop->slug)}}">{{$workshop->title}}</a>
                                </td>
                            <td style="width: fit-content;">{{$workshop->start_date->format('d.m.y')}}</td>
                            <td style="width: fit-content;">{{$workshop->location}}</td>
                            <td>
                                @foreach ($workshop['clients'] as $client)
                                        <a href="{{url('clients/'.$client->slug)}}">{{$client->first_name .' '. $client->last_name}}</a> /
                                @endforeach
                            </td>
                            <td>
                                @if ($workshop->canceled)
                                    <span style="color:red; font-weight: bold">Ja</span>
                                @endif
                            </td>
                            <td>
                                {{$workshop->canceled_by}}</td>
                            <td style="text-align: right">
                            @if (!$workshop->canceled && $workshopFilter === 'future')
                            <button class="editButton" wire:click.prevent="cancelWorkshop({{$workshop}})" name="future">Storno</button>
                                @endif
                                @if ($workshopFilter === 'canceled')
                                    <button class="editButton" wire:click.prevent="workshopReactivation({{$workshop}})" name="future">Reaktivieren</button>
                                @endif
                            </td>
                        </tr>


           <tr class="dividerLine"></tr>
                    @endforeach
                </table>
            </div>
        @else
            <div class="ml-6 mr-6 mb-12">{{trans('companies.labels.noStaff')}}</div>
        @endif
    </div>
