<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <style>
        th.largeText {

            font-size: large;
        }

        th.large {
            width: 70%;

        }

        th.medium {
            width: 25%;

        }

        th.small {
            width: 5%;

        }

        div.spacer {
            height: 50px;
        }
    </style>
    <div class="bg-gray-50">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
            <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                <span class="block">Ready to dive in?</span>
                <span class="block text-indigo-600">Start your free trial today.</span>
            </h2>
            <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                <div class="inline-flex rounded-md shadow">
                    <a href="#" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700"> Get started </a>
                </div>
                <div class="ml-3 inline-flex rounded-md shadow">
                    <a href="#" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-indigo-50"> Learn more </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row py-2 px-lg-2">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 text-center">
                    <span style="font-weight: bold"><h3>{{trans('dashboard.general.welcome')}}</h3></span>
                </div>
                <div class="bg-white  border-gray-200">
                    <div class="row pt-1 pl-lg-3 pb-3 bg-white  border-gray-200">
                        <div class="col">

                            {{--                             TODO-blade Create canceldate tables for tQonline--}}
                            <span class="ml-4"><strong>{{trans('dashboard.workshops.deadlineShort')}}</strong></span>
                            <table class="table table-striped table-sm data-table table-hover">
                                <thead>
                                <tr>
                                    <th class="pb-2 large largeText"
                                        id="title">{!! trans('dashboard.workshops.deadlineTitle') !!}</th>
                                    <th class="pb-2 medium largeText"
                                        id="deadlineDays">{!! trans('dashboard.workshops.deadlineDays') !!}</th>
                                    <th class="pb-2 small largeText"
                                        id="occupancyRate">{!! trans('dashboard.workshops.occupancyRate') !!}</th>
                                </tr>
                                </thead>
                                <tbody id="deadline_long_workshops_table">

                                @foreach($dashboardCollection->urgentWorkshops as $workshop)

                                    @if ($workshop->cancel_days <= 8)
                                        <tr>
                                            <td class="pb-2">
                                                <span class="sc-tooltip" data-tooltip="{{$workshop->title.' '.$workshop->start_date->format('d.m.y').' in '.$workshop->location}}"/>
                                                <a href="{{url('workshops/'.$workshop->slug)}}"
                                                   title="{{$workshop->title}} {{$workshop->start_date->format('d.m.y')}}"><span
                                                        style=" font-weight: bold">{{$workshop->title}}</span></a></td>
                                            <td class="pb-2">
                                                <span style="color: #be0626; font-weight: bold"
                                                      title="{{trans('dashboard.workshops.cancellationDate')}} {{$workshop->cancellation_date->format('d.m.y')}}">{{$workshop->cancel_days}} {{trans('dashboard.general.days')}}</span>
                                            </td>
                                            <td class="pb-2" style="text-align: end">
                                                {{--Colorize by OccupancyRate--}}
                                                <span style="color: #5ac45e; font-weight: bold"> {{$workshop->booked ?? 0}}</span>
                                                <span style="color: gold; font-weight: bold"> {{$workshop->reserved ??  0}}</span>
                                                <span style="color: #be0626; font-weight: bold">{{12-$workshop->booked-$workshop->reserved}}</span>
                                            </td>
                                        </tr>
                                    @endif

                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="col">
                            <span class="ml-4"><strong> {{trans('dashboard.workshops.deadlineMedium')}}</strong></span>
                            <table class="table table-striped table-sm data-table table-hover">
                                <thead>
                                <tr>
                                    <th class="pb-2 large largeText"
                                        id="title">{{ trans('dashboard.workshops.deadlineTitle') }}</th>
                                    <th class="pb-2 medium largeText"
                                        id="deadlineDays">{{ trans('dashboard.workshops.deadlineDays') }}</th>
                                    <th class="pb-2 small largeText" id="occupancyRate"
                                        style="align-content: end">{!! trans('dashboard.workshops.occupancyRate') !!}</th>
                                </tr>
                                </thead>
                                <tbody id="deadline_long_workshops_table">

                                @foreach($dashboardCollection->urgentWorkshops as $workshop)

                                    @if ($workshop->cancel_days > 8 && $workshop->cancel_days < 31 )
                                        <tr>
                                            <td class="pb-2">
                                                <span class="sc-tooltip" data-tooltip="{{$workshop->title.' '.$workshop->start_date->format('d.m.y').' in '.$workshop->location}}"/>
                                                <a href="{{url('workshops/'.$workshop->slug)}}"
                                                                title="{{$workshop->title}} {{$workshop->start_date->format('d.m.y')}}"><span
                                                        style=" font-weight: bold">{{$workshop->title}}</span></a></td>
                                            <td class="pb-2">

                                                <span style="color: gold; font-weight: bold"
                                                      title="{{trans('dashboard.workshops.cancelationDate')}} {{$workshop->cancellation_date->format('d.m.y')}}">{{$workshop->cancel_days}} {{trans('dashboard.general.days')}}</span>


                                            </td>
                                            <td class="pb-2" style="text-align: end">
{{--                                                Colorize by OccupancyRate--}}
                                                <span style="color: gold; font-weight: bold"> {{$workshop->reserved ??  0}}</span>
                                                <span style="color: #5ac45e; font-weight: bold"> {{$workshop->booked ?? 0}}</span>
                                                <span style="color: #be0626; font-weight: bold">{{12-$workshop->booked-$workshop->reserved}}</span>
                                        </tr>
                                    @endif

                                @endforeach

                                </tbody>
                            </table>
                        </div>

                        <div class="col">
                            <span class="ml-4"><strong>{{trans('dashboard.workshops.deadlineLong')}}</strong></span>
                            <table class="table table-striped table-sm data-table table-hover">
                                <thead>
                                <tr>
                                    <th class="pb-2 large largeText"
                                        id="title">{!! trans('dashboard.workshops.deadlineTitle') !!}</th>
                                    <th class="pb-2 medium largeText"
                                        id="deadlineDays">{!! trans('dashboard.workshops.deadlineDays') !!}</th>
                                    <th class="pb-2 small largeText"
                                        id="occupancyRate">{!! trans('dashboard.workshops.occupancyRate') !!}</th>
                                </tr>
                                </thead>
                                <tbody id="deadline_long_workshops_table">
                                @foreach($dashboardCollection->urgentWorkshops as $workshop)
                                    @if ($workshop->cancel_days > 31)
                                        <tr>
                                            <td class="pb-2 col-6">
                                                <span class="sc-tooltip" data-tooltip="{{$workshop->title.' '.$workshop->start_date->format('d.m.y').' in '.$workshop->location}}"/>
                                                <a href="{{url('workshops/'.$workshop->slug)}}"
                                                                      title="{{$workshop->title}} {{$workshop->start_date->format('d.m.y')}}"><span
                                                        style=" font-weight: bold">{{$workshop->title}}</span></a></td>
                                            <td class="pb-2 col-3">
                                                <span style="color: #5ac45e; font-weight: bold"
                                                      title="{{trans('dashboard.workshops.cancellationDate')}} {{$workshop->cancellation_date->format('d.m.y')}}">{{$workshop->cancel_days}} {{trans('dashboard.general.days')}}</span>
                                            </td>
                                            <td class="pb-2 col-3" style="text-align: end">
                                                {{--Colorize by OccupancyRate--}}
                                                <span style="color: gold; font-weight: bold"> {{$workshop->reserved ??  0}}</span>
                                                <span style="color: #5ac45e; font-weight: bold"> {{$workshop->booked ?? 0}}</span>
                                                <span style="color: #be0626; font-weight: bold">{{12-$workshop->booked-$workshop->reserved}}</span>
                                            </td>
                                        </tr>
                                    @endif

                                @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="row spacer">

                    </div>
                    <div class="row pt-1 pl-lg-3">
                        <div class="col">
                            <span class="ml-4"><strong>{{trans('dashboard.workshops.upcoming')}}</strong></span>
                            <div class="table-responsive">
                                <table class="table table-striped table-sm data-table table-hover">
                                    <thead>
                                    <tr>
                                        <th class="pb-2 large largeText"
                                            id="title">{!! trans('dashboard.workshops.title') !!}</th>
                                        <th class="pb-2 medium largeText"
                                            id="date">{!! trans('dashboard.workshops.begin') !!}</th>
                                        <th class="pb-2 small largeText"
                                            id="occupancyRate">{!! trans('dashboard.workshops.occupancyRate') !!}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="upcoming_workshops_table">
                                    @foreach($dashboardCollection->upcomingWorkshops as $workshop)
                                        <tr>

                                            <td class="pb-2">
                                            <span class="sc-tooltip"
                                                  data-tooltip="{{$workshop->title.' '.$workshop->start_date->format('d.m.y').' in '.$workshop->location}}">
                                            <a href="{{'/workshops/'.$workshop->slug}}">{{$workshop->title}}</a> </span>
                                            </td>
                                            <td class="pb-2">{{$workshop->start_date->format('d.m.y')}}</td>
                                            <td class="pb-2">
                                                {{--Colorize by OccupancyRate--}}
                                                <span style="color: gold; font-weight: bold"> {{$workshop->reserved ??  0}}</span>
                                                <span style="color: #5ac45e; font-weight: bold"> {{$workshop->booked ?? 0}}</span>
                                                <span style="color: #be0626; font-weight: bold">{{12-$workshop->booked-$workshop->reserved}}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col">
                            <span class="ml-4"><strong>{{trans('dashboard.companies.latest')}}</strong></span>
                            <div class="table-responsive">
                                <table class="table table-striped table-sm data-table table-hover">
                                    <thead>
                                    <tr>
                                        <th class="pb-2 large largeText"
                                            id="title">{!! trans('dashboard.companies.name') !!}</th>
                                        <th class="pb-2 medium largeText"
                                            id="date">{!! trans('dashboard.companies.creationDate') !!}</th>

                                    </tr>
                                    </thead>
                                    <tbody id="upcoming_workshops_table">
                                    @foreach($companies as $company)
                                        <tr>
                                            <td class="pb-2">
                                                <a href="{{'/companies/'.$company->slug}}">{{$company->name}}</a> </span>
                                            </td>
                                            <td>{{$company->created_at->format('d.m.y')}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col">
                            <span class="ml-4"><strong>{{trans('dashboard.clients.latest')}}</strong></span>
                            <div class="table-responsive">
                                <table class="table table-striped table-sm data-table table-hover">
                                    <thead>
                                    <tr>
                                        <th class="pb-2 large largeText"
                                            id="clientName">{!! trans('dashboard.clients.name') !!}</th>
                                        <th class="pb-2 medium largeText"
                                            id="clientCreationDate">{!! trans('dashboard.clients.creationDate') !!}</th>
                                        <th class="pb-2 small largeText"
                                            id="clientBooked">{!! trans('dashboard.clients.bookedWorkshop') !!}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="latest_clients_table">
                                    @foreach($clients as $client)
                                        <tr>

                                            <td class="pb-2">
                                            <span class="sc-tooltip"
                                                  data-tooltip="{{$client->title.' '.$client->first_name.' '.$client->last_name}}">
                                            <a href="{{'/clients/'.$client->slug}}">{{$client->first_name.' '.$client->last_name}}</a> </span>
                                            </td>
                                            <td class="pb-2">{{$client->created_at->format('d.m.y')}}</td>
                                            <td class="pb-2">
                                                @if(count($client->workshops) > 0)
                                                    <span>{{ trans('dashboard.general.yes') }}</span>
                                                @else
                                                    <span>{{ trans('dashboard.general.no') }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
