<div>
    <style>
        .listItem {
            display: flex;

            position: relative;
            border-left: #98ca52 solid 1px;
            border-right: #98ca52 solid 1px;
            background-color: white;
            z-index: 999999;
            text-align: center;
            padding: 8px;
        }
        .listItem:hover {
            background-color: #98ca52;
            color: white;
        }
        .listItem:last-child {
            display: flex;
            position: relative;
            border-bottom: #98ca52 solid 2px;
        }
    </style>
    <div class="w-full" style="height: 100px">
        <div class="row">
            <div class="col-12">
                <x-shdw-input name="selectedStaff.last_name" label="Mitarbeiter" disabled=""/>
                <x-shdw-input name="searchStaff" label="Mitarbeiter"/>
            </div>

        </div>
        <div wire:loading>Suche...</div>
        <div wire:loading.remove></div>

        <div style="z-index: 999999">
            @if ($results)
                <ul class="searchResults">
                    @foreach($results->clients as $client)
                        <li wire:click.prevent="selectClient({{$client}})" class="listItem">{{ $client->first_name.' '.$client->last_name }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>


