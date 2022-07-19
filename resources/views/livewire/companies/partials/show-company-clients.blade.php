<div class="row col-12 pt-3 pb-3">
    <div class="col-6">
        <div class="ml-6"><strong>{{ trans('companies.labels.clients') }}</strong></div>
        @if (count($company->clients) > 0)
            <div class="ml-6">
                @foreach($company->clients as $client)
                    <a href="{{url('clients/'.$client->slug)}}"
                       title="test">{{$client->first_name .' '. $client->last_name}}</a> /
                @endforeach
            </div>
        @else
            <div class="ml-6">{{trans('companies.labels.noClients')}}</div>
        @endif
    </div>
</div>
