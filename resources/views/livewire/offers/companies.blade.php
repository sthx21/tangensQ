
<div class="w-full" style="height: 100px">
    <style>
        .listItem {
            display: flex;
            width: 100%;
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
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }
        .listItem:first-child {
            display: flex;
            position: relative;
            border-top: #98ca52 solid 2px;
        }
    </style>
    <div class="row">
    <div class="col-12">
    <x-shdw-input name="search" label="Unternehmen/Klienten"/>
    </div>

    </div>
    <div wire:loading>Suche...</div>
    <div wire:loading.remove></div>

    <div>
        @if ($results)
            <ul class="searchResults">
                @foreach($results->companies as $company)
                    <li wire:click.prevent="$emit('selectCompany', {{$company}})" class="listItem">{{ $company->name }}</li>
                @endforeach
            </ul>
            <ul class="searchResults">
                @foreach($results->clients as $client)
                    <li wire:click.prevent="$emit('selectClient', {{$client}})" class="listItem">{{ $client->first_name.' '.$client->last_name }}</li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
