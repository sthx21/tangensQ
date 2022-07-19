<div class="row py-3">
    <div class="col-6">
        <div class="ml-6"  style="text-align: left"><strong>{{ trans('companies.labels.clients') }}</strong></div>
        @if (count($company->clients) > 0)
            <div class="ml-6">
                <table>
                    <thead>
                    <tr style="border-bottom: black solid 1px; border-bottom-left-radius: 4px">
                        <th style="text-align: left">Name</th>
                        <th>Entfernen</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($company->clients as $client)
                    <tr style="text-align: left">
                        <td>
                            <a href="{{url('clients/'.$client->slug)}}"
                               title="test">{{$client->first_name .' '. $client->last_name}}</a>
                        </td>
                        <td style="text-align: right">
                            <button name="removeClient" class="removeButtonCircle" wire:click.prevent="removeClient({{$client->id}})">X</button>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="ml-6 text-left">{{trans('companies.labels.noClients')}}</div>
        @endif
    </div>
    <div class="col-md-6 col-12">
        <div>
            @foreach ($company->tags as $tag)
                <span class="mt-1 addedTag">{{$tag['name']}}<span class="removeTag" wire:click.prevent="removeTag({{$tag['id']}})" wire:key="tag.{{$tag->id}}">X</span></span>
            @endforeach
        </div>
        <div>
            <x-shdw-input name="addTag" label="Tag hinzufügen"/>
            <div>
                @if ($results)
                    <ul class="searchResults">
                        <li wire:click.prevent="createTag()" wire:key="123">Neuer Tag : {{$addTag}}</li>
                        @foreach($results as $tag)
                            <li wire:click.prevent="addTag({{$tag}})">{{ $tag->name }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

    </div>
</div>
