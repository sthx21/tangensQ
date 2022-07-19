<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <x-index-create>

        <div class="flex-fill">
            <div class="flex-row">
                <div class="flex-column col-12">
                    <div class="card">
                        <div class="card-header d-sm-flex flex-sm-row">
                            <div class="pb-sm-4">
                               <h4> {!! trans('webexes.showing-webex-title', ['name' => $webex->title]) !!}</h4>
                            </div>

                                <div class="ml-auto">
                                    <div class="btn-group">
                                        <x-button-link :link="'/webex/'" :class="'btn-info'"
                                                       :title="'Back to All webexes'">
                                            {{trans('webexes.general.back')}}</x-button-link>
                                        <x-button-link :link="route('editClients', $webex->slug)"
                                                       :class="'btn-success'"
                                                       :title="trans('webexes.tooltips.editClients')">{{ trans('webexes.buttons.editClients') }}</x-button-link>
                                        <x-button-link :link="'/webex/'.$webex->slug.'/edit'"
                                                       :class="'btn-primary'"
                                                       :title="trans('webexes.tooltips.edit')">{{ trans('webexes.buttons.edit') }}</x-button-link>
                                        @if ($webex->canceled === 0)
                                            <x-buk-form-button :action="route('cancelwebex', $webex->slug)"
                                                               method="put" :class="'btn-warning'"
                                                               :title="trans('webexes.tooltips.cancelwebex') "
                                                               onclick="return confirm('{{trans('webexes.confirm.Cancel')}}')">{{trans('webexes.buttons.cancelwebex')}}
                                            </x-buk-form-button>
                                        @endif
                                        @if ($webex->canceled === 1)
                                            <x-buk-form-button :action="route('uncancelwebex', $webex->slug)"
                                                               method="put" :class="'btn-warning'"
                                                               :title="trans('webexes.tooltips.uncancelwebex') "
                                                               onclick="return confirm('{{trans('webexes.confirm.Restore')}}')">{{trans('webexes.buttons.uncancelwebex')}}
                                            </x-buk-form-button>
                                        @endif
                                        <x-buk-form-button :action="route('webex.destroy', $webex)"
                                                           method="delete" :class="'btn-danger'"
                                                           :title="trans('webexes.buttons.delete')"
                                                           onclick="return confirm('{{trans('webexes.confirm.Delete')}}')">{{trans('webexes.buttons.delete')}}
                                        </x-buk-form-button>
                                    </div>
                                </div>

                        </div>
                        <div class="card-body pl-2">
                            <div class="row text-center text-left-tablet mb-4">
                                <div class="col-4">
                                    <h4 class="text-black margin-top-sm-1 text-center text-left-tablet">
                                        {{trans('webexes.labels.webex')}}<br> {{ $webex->title }}<br></h4>
                                    <h4 class="text-black margin-top-sm-1 text-center text-left-tablet">
                                        {{ trans('webexes.labels.webex_additional_title') }}<br>{{$webex->additional_title}}</h4>
                                    <p class="text-center text-left-tablet">

                                    <div class="text-center pb-3">
                                        <div class="btn-group align-content-center" role="group"
                                             aria-label="{{trans('webexes.buttons.group')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div>

                                            <div><strong>{{ trans('webexes.labels.Location') }}</strong></div>
                                            <div>{{ $webex->location }}</div>

                                    </div>
                                    <div>

                                            <div><strong>{{ trans('webexes.labels.Date') }}</strong></div>
                                            <div>{{$webex->start_date->format('d.m.y'). ' - ' .$webex->end_date->format('d.m.y')}}</div>

                                    </div>
                                    <div>

                                            <div><strong>{{ trans('webexes.labels.Price') }}</strong></div>
                                            <div>{{$webex->price}},00 €</div>

                                    </div>
                                </div>
                                <div class="col-4">
                                    <div><strong>{{ trans('webexes.labels.Status') }}</strong>
                                    </div>
                                    <div>
                                        @if($webex->start_date->lt($today))
                                            {{trans('webexes.general.ended')}}
                                        @elseif($webex->start_date->gt($today))
                                            {{trans('webexes.general.upcoming')}} {{$webex->start_date->diffInDays($today)}} {{trans('webexes.general.days')}}
                                        @endif
                                        @if($webex->start_date->eq($today))
                                            ACTIVE
                                        @endif
                                    </div>
                                    <div>
                                        <strong>

                                                {{trans('webexes.index.trainer')}} <br>

                                            @foreach($webex->trainers as $trainer)
                                                <span class="text-center" data-toggle="tooltip" data-placement="top"
                                                      title="{{ trans('webexes.tooltips.trainer') }}">
                                            <a href="{{url('trainers/'.$trainer->slug)}}"
                                               title="test">{{$trainer->first_name}}   {{$trainer->last_name}}</a> /
                                            @endforeach
                                        </strong>
                                    </div>
                                    <div>
                                        <strong>{{trans('webexes.labels.OccupancyRate')}}</strong>
                                        {{--Colorize by OccupancyRate--}}
                                        @if ($webex->occupancyRate <= 3 && $webex->occupancyRate > 0)
                                            <h5><span style="color: #be0626; font-weight: bold">{{$webex->occupancyRate}}{{trans('webexes.labels.OccupancyRateClients')}}</span></h5>
                                        @endif
                                        @if ($webex->occupancyRate > 3 && $webex->occupancyRate <= 9 )
                                            <h5><span style="color: gold; font-weight: bold">{{$webex->occupancyRate}}{{trans('webexes.labels.OccupancyRateClients')}}</span></h5>
                                        @endif
                                        @if ($webex->occupancyRate > 9 )
                                            <h5><span style="color: #5ac45e; font-weight: bold;">{{$webex->occupancyRate}}{{trans('webexes.labels.OccupancyRateClients')}}</span></h5>
                                        @endif
                                        @if($webex->occupancyRate == 0)
                                            <h5><div><span style="color: #be0626; font-weight: bold">{{trans('webexes.index.unbooked')}}</span></div></h5>
                                            @endif
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
                                    {{ trans('webexes.labels.Details') }}
                                </strong>
                            </div>
                            <div class="ml-6">
                                {{ $webex->detail }}
                            </div>

                            </div>
                            <div class="col-6">

                            <div>
                                <strong>
                                    {{ trans('webexes.labels.TopicCoreQuestions') }}
                                </strong>
                            </div>
                            <div>
{{--                                {{$webex->topic_coreQuestions}}--}}
                                {{--                                        TODO One Line per process point   --}}

                                                    @foreach($webex->topic_coreQuestions as $topic)
                                                    - {{$topic}} <br>
                                                    @endforeach
                            </div>

                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>
                        <div class="row col-12 pt-3 pb-3">
                            <div class="col-6">

                                    <div class="ml-6">
                                        <strong>
                                            {{ trans('webexes.labels.Targets') }}
                                        </strong>
                                    </div>
                                    <div class="ml-6">
                                        {{ $webex->targets }}
                                    </div>

                            </div>
                            <div class="col-6">

                                    <div>
                                        <strong>
                                            {{ trans('webexes.labels.ProcessFlow') }}
                                        </strong>
                                    </div>
                                    <div>
                                        {{$webex->process_flow}}
{{--                                        TODO One Line per process point   --}}
                                        {{--                    @foreach($webex->process_flow as $process)--}}
                                        {{--                    - {{$process}} <br>--}}
                                        {{--                    @endforeach--}}
                                    </div>

                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>
                        <div class="row col-12 pt-3 pb-3">
                            <div class="col-6">
                                    <div class="ml-6">
                                        <strong>
                                            {{ trans('webexes.labels.Misc') }}
                                        </strong>
                                    </div>
                                    <div class="ml-6">
                                        {{ $webex->misc }}
                                    </div>
                            </div>
                            <div class="col-6">
                                    <div>
                                        <strong>
                                            {{ trans('webexes.labels.MiscLink') }}
                                        </strong>
                                    </div>
                                    <div>
                                        <a href="{{$webex->misc_link}}">{{$webex->misc_link}}</a>
                                    </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>
                        <div class="row col-12 pt-3 pb-3">
                            <div class="col-6">
                                <div class="ml-6">
                                    <strong>
                                        {{ trans('webexes.labels.password') }}
                                    </strong>
                                </div>
                                <div class="ml-6">
                                    {{ $webex->password }}
                                </div>
                            </div>
                            <div class="col-6">
                                <div>
                                    <strong>
                                        {{ trans('webexes.labels.webLink') }}
                                    </strong>
                                </div>
                                <div>
                                    <a href="{{$webex->webLink}}">{{$webex->webLink}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>





                        <div class="row col-12 pt-3 pb-3">
                            <div class="col-6">
                                <div class="ml-6"><strong>{{ trans('webexes.labels.Clients') }}</strong></div>
                                @if (count($webex->clients) > 0)
                                    <div class="ml-6">
                                        @foreach($webex->clients as $client)
                                            <a href="{{url('clients/'.$client->slug)}}"
                                               title="test">{{$client->first_name .' '. $client->last_name}}</a> /
                                        @endforeach
                                    </div>
                                @else
                                    <div class="ml-6">{{trans('webexes.index.unbooked')}}</div>
                                @endif
                            </div>


                            <div class="col-6">
                                <strong>
                                    {{ trans('webexes.labels.OtherDates') }} <br>
                                </strong>
                        @if($webex->series_two !== null)


                                <a href="{{url('webex/'.$webex->series_two->slug)}}"
                                   title="test">{{$webex->series_two->title.' '. $webex->series_two->start_date. ' '. $webex->series_two->location}}</a><br>
                                @endif
                                @if($webex->series_three !== null)


                                    <a href="{{url('webex/'.$webex->series_three->slug)}}"
                                       title="test">{{$webex->series_three->title.' '. $webex->series_three->start_date. ' '. $webex->series_three->location}}</a><br>
                                @endif
                                @if($webex->series_four !== null)


                                    <a href="{{url('webex/'.$webex->series_four->slug)}}"
                                       title="test">{{$webex->series_four->title.' '. $webex->series_four->start_date. ' '. $webex->series_four->location}}</a><br>
                                @endif

                            </div>


                                <div class="clearfix"></div>
                                <div class="border-bottom"></div>
                        </div>

                    </div>

                </div>

        </div>
        </div>
    </x-index-create>

</x-app-layout>
