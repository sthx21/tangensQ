<div class="row pt-3 pb-3">
    <div class="col-6 w-full">
        <div class="ml-6"><strong>{{ trans('companies.labels.workshopActive') }}</strong></div>
        @if (count($active) >= 0)
            <div class="ml-6">
                <table class="companyWorkshopTable" style="width: 100%;">
                    <thead>
                    <tr>
                    <th>{{ trans('companies.labels.workshopClients') }}</th>
                    <th>{{ trans('companies.labels.workshopTitle') }}</th>
                    <th>{{ trans('companies.labels.workshopDate') }}</th>
                    <th>{{ trans('companies.labels.workshopCanceledBy') }}</th>
                        </tr>
                    </thead>

                    @foreach ($active as $future)

                    <tr>
                        <td></td>
                        <td>{{$future->title}}</td>
                        <td>{{$future->start_date}}</td>
                        <td>{{$future->canceled}}</td>
                    </tr>
                        @endforeach
                    <tr class="dividerLine"></tr>
                </table>
            </div>
        @else
            <div class="ml-6">{{trans('companies.labels.noStaff')}}</div>
        @endif
    </div>

    <div class="col-6 w-full">
        <div class="ml-6"><strong>{{ trans('companies.labels.workshopsHistory') }}</strong></div>
        @if (count($history) > 0)
            <div class="ml-6">
                <table class="companyWorkshopHistoryTable" style="width: 100%;">
                    <thead>
                    <tr>
                        <th>{{ trans('companies.labels.workshopTitle') }}</th>
                        <th>{{ trans('companies.labels.workshopDate') }}</th>
                        <th>{{ trans('companies.labels.workshopClients') }}</th>
                        <th>{{ trans('companies.labels.workshopCanceledBy') }}</th>
                    </tr>
                    </thead>
                    @foreach($history as $past)
                        <tr>
                            <td style="width: max-content">{{$past->title}}</td>
                            <td style="width: max-content">{{$past->start_date}}</td>
                            <td style="width: min-content">
                                @foreach ($past['clients'] as $client)
                                    @if ($clients->contains($client->id))
                                        <a href="{{url('clients/'.$client->slug)}}">{{$client->first_name .' '. $client->last_name}}</a> /
                                    @endif
                                @endforeach
                            </td>
                            <td>TODO</td>
                        </tr>


           <tr class="dividerLine"></tr>
                    @endforeach
                </table>
            </div>
        @else
            <div class="ml-6">{{trans('companies.labels.noStaff')}}</div>
        @endif
    </div>
</div>
