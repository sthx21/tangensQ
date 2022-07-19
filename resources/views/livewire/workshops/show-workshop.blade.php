<div>
    <div class="flex-fill">
        <div class="flex-row">
            <div class="flex-column col-12">
                <div class="card">
                    <div class="card-header d-sm-flex flex-sm-row justify-content-between">
                        <div class="pb-sm-4">
                            <h4> {!! trans('workshops.showing-workshop-title', ['name' => $workshop->title]) !!}</h4>
                        </div>
                        <div class="ml-auto">
                                <button class="editButton" wire:click.prevent="editWorkshop({{$workshop}})" wire:key="edit.{{$workshop->id}}">{{trans('workshops.buttons.edit')}}</button>
                                <button class="backToButton" name="backToButton" wire:click.prevent="backToWorkshops()">{{trans('workshops.buttons.backToWorkshops')}}</button>
                                @if (!$workshop->canceled)
                                    <button class="removeButton" wire:click.prevent="setStatus()" wire:key="edit.{{$workshop->id}}">{{trans('workshops.buttons.cancelWorkshop')}}</button>
                                @endif
                                @if ($workshop->canceled)
                                <button class="editButton" wire:click.prevent="setStatus()" wire:key="edit.{{$workshop->id}}">{{trans('workshops.buttons.uncancelWorkshop')}}</button>
                            @endif
                        </div>
                    </div>
                    <div class="card-body pl-2">
                        <div class="row text-center text-left-tablet mb-4">
                            <div class="col-4">
                                <h4 class="text-black margin-top-sm-1 text-center text-left-tablet">
                                    {{trans('workshops.show.title')}}<br> {{ $workshop->title }}<br></h4>
                                <h4 class="text-black margin-top-sm-1 text-center text-left-tablet">
                                    {{ trans('workshops.show.additional_title') }}<br>{{$workshop->additional_title}}</h4>
                                <p class="text-center text-left-tablet">

                                <div class="text-center pb-3">
                                    <div class="btn-group align-content-center" role="group"
                                         aria-label="{{trans('workshops.buttons.group')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div>

                                    <div><strong>{{ trans('workshops.show.location') }}</strong></div>
                                    <div>{{ $workshop->location }}</div>

                                </div>
                                <div>

                                    <div><strong>{{ trans('workshops.show.date') }}</strong></div>
                                    <div>{{$workshop->start_date. ' - ' .$workshop->end_date}}</div>
                                    <div>{{$workshop->start_time.' Uhr'. ' - ' .$workshop->end_time.' Uhr'}}</div>
                                </div>
                                <div>

                                    <div><strong>{{ trans('workshops.show.price') }}</strong></div>
                                    <div>{{$workshop->price}},00 €</div>

                                </div>
                            </div>
                            <div class="col-4">
                                <div><strong>{{ trans('workshops.show.cancelDays') }}</strong>
                                    <div>{{$workshop->cancellation_date}}</div>
                                </div>
                                <div>
{{--                                    @if($workshop->cancellation_date->lt($today))--}}
{{--                                        {{trans('workshops.general.ended')}}--}}
{{--                                    @elseif($workshop->cancellation_date->greaterThan($today))--}}
{{--                                        {{trans('workshops.general.upcoming')}} {{daysToBegin($workshop->cancellation_date)}} {{trans('workshops.general.days')}}--}}
{{--                                    @endif--}}
{{--                                    @if($workshop->cancellation_date->eq($today))--}}
{{--                                        <span style="color: #be0626; font-weight: bold">FRISTENDE HEUTE</span>--}}

{{--                                    @endif--}}
                                </div>
                                <div><strong>{{ trans('workshops.show.begin') }}</strong>
                                </div>
                                <div>
{{--                                    @if($workshop->start_date->lt($today))--}}
{{--                                        {{trans('workshops.general.ended')}}--}}
{{--                                    @elseif($workshop->start_date->gt($today))--}}
{{--                                        {{trans('workshops.general.upcoming')}} {{daysToBegin($workshop->start_date)}} {{trans('workshops.general.days')}}--}}
{{--                                    @endif--}}
{{--                                    @if($workshop->start_date->eq($today))--}}
{{--                                        ACTIVE--}}
{{--                                    @endif--}}
                                </div>
                                <div>
                                    <strong>

                                        {{trans('workshops.index.trainer')}} <br>

                                        @foreach($workshop->trainers as $trainer)
                                            <span class="text-center" data-toggle="tooltip" data-placement="top"
                                                  title="{{ trans('workshops.tooltips.trainer') }}">
                                            <a href="{{url('trainers/'.$trainer->slug)}}"
                                               title="test">{{$trainer->first_name}}   {{$trainer->last_name}}</a> /
                                        @endforeach
                                    </strong>
                                </div>
                                <div>
                                    <strong>{{trans('workshops.show.occupancyRate')}}</strong>
                                    {{--Colorize by OccupancyRate--}}
                                    @php($rate = occupancyRate($workshop->clients->count()))

                                    <h5><span style="color: {{$rate['colour']}}; font-weight: bold">{{$rate['rate']}}</span></h5>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="border-bottom"></div>

                    <div class="row col-12 pt-3 pb-3">
                        <div class="col-6">

                            <div class="ml-6">
                                <strong>
                                    {{ trans('workshops.show.details') }}
                                </strong>
                            </div>
                            <div class="ml-6">
                                {{ $workshop->detail }}
                            </div>

                        </div>
                        <div class="col-6">

                            <div>
                                <strong>
                                    {{ trans('workshops.show.topicCoreQuestions') }}
                                </strong>
                            </div>
                            <div>
                                @if ($workshop->topic_coreQuestions)
                                    @foreach($workshop->topic_coreQuestions as $topic)
                                        <em class="fas fa-circle fa-xs"></em>    {{$topic['topic']}}<br>
                                    @endforeach
                                @endif

                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="border-bottom"></div>
                    <div class="row col-12 pt-3 pb-3">
                        <div class="col-6">

                            <div class="ml-6">
                                <strong>
                                    {{ trans('workshops.show.targets') }}
                                </strong>
                            </div>
                            <div class="ml-6">
                                {{ $workshop->targets }}
                            </div>

                        </div>
                        <div class="col-6">

                            <div>
                                <strong>
                                    {{ trans('workshops.show.processFlow') }}
                                </strong>
                            </div>
                            <div>
                                {{$workshop->process_flow}}

                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="border-bottom"></div>
                    <div class="row col-12 pt-3 pb-3">
                        <div class="col-6">

                            <div class="ml-6">
                                <strong>
                                    {{ trans('workshops.show.misc') }}
                                </strong>
                            </div>
                            <div class="ml-6">
                                {{ $workshop->misc }}
                            </div>

                        </div>
                        <div class="col-6">

                            <div>
                                <strong>
                                    {{ trans('workshops.show.miscLink') }}
                                </strong>
                            </div>
                            <div>
                                <a href="{{$workshop->misc_link}}">{{$workshop->misc_link}}</a>

                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="border-bottom"></div>
                    <div class="row col-12 pt-3 pb-3">
                        <div class="col-md-6 col-12 pt-3 ml-md-6">
                            <strong class="ml-6">{{trans('workshops.show.bookedClients')}}</strong>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>{{trans('workshops.show.hrClientName')}}</th>
                                    <th>{{trans('workshops.show.clientFirm')}}</th>
                                    <th>{{trans('workshops.show.status')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($workshop->staff) > 0)
                                @foreach($workshop->staff as $hr)
                                    <tr>
                                        <td>  <a href="{{url('/staff/'.$hr->slug)}}"
                                                 title="test">{{$hr->first_name .' '. $hr->last_name}}</a></td>
                                        <td>{{$hr->company->name}}</td>
                                        <td><div class="btn-group">
                                                <button class="btn btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    {{$hr->pivot->status}}
                                                </button>
                                                <div class="dropdown-menu">
                                                    @foreach ($status as $st)
                                                        <a class="dropdown-item" href="#" wire:click.prevent="changeStatus({{$hr}},'{{$st}}')" wire:key="hr.{{$hr->id}}">{{$st}}</a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                    <div class="ml-6">{{trans('workshops.show.noStaffClients')}}</div>
                                @endif
                                @if (count($workshop->clients) > 0)
                                    @foreach($workshop->clients as $client)
                                        <tr>
                                            <td>  <a href="{{url('/clients/'.$client->slug)}}"
                                                     title="test">{{$client->first_name .' '. $client->last_name}}</a></td>
                                            <td>{{$client->company->name}}</td>
                                            <td><div class="btn-group">
                                                    <button class="btn btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        {{$client->pivot->status}}
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        @foreach ($status as $st)
                                                            <a class="dropdown-item" href="#" wire:click.prevent="changeStatus({{$client}},'{{$st}}')" wire:key="client.{{$client->id}}">{{$st}}</a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <div class="ml-6">{{trans('workshops.show.noClients')}}</div>
                                @endif

                                </tbody>
                            </table>
                        </div>

                        <div class="col-6">
                            <strong>
                                {{ trans('workshops.show.otherDates') }} <br>
                            </strong>
                            @if ($workshop->linked)
                                @foreach ($workshop->linked as $linkedWorkshop)
                                    <a href="{{url('workshops/'.$linkedWorkshop->slug)}}"
                                       title="{{$linkedWorkshop->title}}">{{$linkedWorkshop->title.' am '. $linkedWorkshop->start_date. ' im '. $linkedWorkshop->location}}</a><br>
                                @endforeach
                            @endif
                        </div>
                        <div class="clearfix"></div>
                        <div class="border-bottom pt-80"></div>
                    </div>

                </div>

            </div>

        </div>
    </div>
    <script>
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
