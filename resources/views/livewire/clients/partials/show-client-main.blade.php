<div class="col-md-9 col-12">
    <div class="card">
        <div class="card-header d-sm-flex flex-sm-row">
            <div class="pb-sm-4 pl-md-2">
                <h4> {!! trans('clients.showing-client', ['name' => $client->last_name]) !!}</h4>
            </div>
            <div class="buttonMenu">
                <button class="editButton" wire:click.prevent="editClient({{$client}})" wire:key="edit.{{$client->id}}">Bearbeiten</button>
                <button class="backToButton" name="backToButton" wire:click.prevent="backToClients()">{{trans('clients.buttons.backToClients')}}</button>
            </div>
        </div>
        <div class="card-body pl-2">
            <div class="row text-center text-left-tablet mb-4">
                <div class="col-md-3 col-12">

                </div>
                <div class="col-md-3 col-12">
                    <div>
                        <strong class="text-black margin-top-sm-1 text-center text-left-tablet">
                            {{trans('clients.labels.company')}}<br> </strong>
                        {{$client->company->name}}<br>
                        {{$client->company->additional_address}}<br>
                        {{ $client->company->street.' '. $client->company->house_number }}<br>
                        {{$client->company->zip.' '.$client->company->city}}<br><br>
                    </div>


                    <strong class="text-black margin-top-sm-1 text-center text-left-tablet">
                        {{trans('clients.labels.name')}}<br> </strong>
                    {{ $client->first_name.' '.$client->last_name }}<br><br>
                    <strong>{{ trans('clients.labels.address') }}<br></strong>
                    {{$client->additional_address}}<br>
                    {{ $client->street.' '. $client->house_number }}<br>
                    {{$client->zip.' '.$client->city}}<br><br>
                    <div>
                        @if($client->homepage)
                            <strong>{{ trans('clients.labels.homepage') }}</strong><br>
                            {!!   Html::link("//$client->homepage", $client->homepage) !!}<br><br>
                        @endif
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div>
                        <strong>
                            {{ trans('clients.labels.email') }}
                        </strong>
                    </div>
                    <div>
                        {{ Html::mailto($client->email, $client->email) }}
                    </div>
                    <div>
                        <strong>
                            {{ trans('clients.labels.phone') }}
                        </strong>
                    </div>
                    <div>
                        {{ $client->phone }}<br>
                        {{ $client->second_phone }}
                    </div>
                    <div>
                        <strong>
                            {{ trans('clients.labels.info') }}
                        </strong>
                    </div>
                    <div>
                        {{ $client->info }}
                    </div>
                </div>
                    <div class="col-md-3 col-12">
                    <div>
                        <strong>
                            {{ trans('clients.labels.createdAt') }}<br>
                        </strong>
                        {{ $client->created_at }}
                    </div>
                    <div>
                        <strong>
                            {{ trans('clients.labels.updatedAt') }}<br>
                        </strong>
                        {{ $client->updated_at }}
                    </div>
                    <div class="mt-8">
                        <strong>
                            {{ trans('clients.labels.responsible') }}
                        </strong>
                    </div>
                    <div>
                     TODO
                    </div>
                </div>
            </div>
                <div class="row border-1">
                    <span style="font-weight: bold">TAGS: </span>
                    @foreach ($client->tags as $tag)
                        <span class="mt-1 addedTag">{{$tag['name']}}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

