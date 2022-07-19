<div>

    <x-slot name="header">
         <div class="lg:px-8" id="heads">
        </div>
    </x-slot>

        <div class="row">
            <div class="col-md-12 col-12 w-full">
            <div class="tableTopMenu">

                <div>
                    <x-shdw-select name="paginateNo" label="" wire:model="paginateNo">
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="500">500</option>
                    </x-shdw-select>
                </div>
                <div class="tableTopRight">
                    <a href="{{route('createOffer')}}"><button class="createReminderButton">{{trans('accounting.offers.create')}}</button> </a>

                    <x-shdw-input name="filter" :label="trans('accounting.offers.searchTitle')"/>
                </div>
            </div>
                <x-index-table>
                <table class="table table-striped table-sm data-table table-hover" id="companies_table">

                    <thead>
                    <tr class="border-black">
                        <th class="tableHeader" wire:click.prevent="sorting('title')">{!! trans('accounting.offers.title') !!}</th>
                        <th class="tableHeader" wire:click.prevent="sorting('amount')">{!! trans('accounting.offers.amount') !!}</th>
                        <th class="tableHeader" wire:click.prevent="sorting('target_date')">{!! trans('accounting.offers.targetDate') !!}</th>
                        <th class="tableHeader" wire:click.prevent="sorting('type')">{!! trans('accounting.offers.type') !!}</th>

                        <th class="tableHeader" wire:click.prevent="sorting('status')">{!! trans('accounting.offers.status') !!}</th>
                        <th class="tableHeader">Upload</th>
                        <th style="text-align: center" class="tableHeader">{!! trans('companies.index.actions') !!}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <div>
                            @foreach ($offers as $offer)
                                <tr>
                                    <td>
                                        {{$offer->companies->first()->name ?? 'Unbekannt'}}<br>
                                        {{$offer->title}}</td>
                                    <td>{{$offer->amount}}</td>
                                    <td>{{$offer->target_date}}</td>
                                    <td>{{$offer->type}}</td>
                                    <td>{{$offer->status}}<br>
                                        @if ($offer->confirmation_date)
                                            {{\Carbon\Carbon::create($offer->confirmation_date)->format('d.m.y')}}
                                        @endif
                                    </td>
                                    <td>
                                        <button onclick="Livewire.emit('openModal', 'helpers.file-uploader', {{ json_encode(["modelType" => 'offer', 'id' => $offer->id])}})" class="uploadButton">PDF</button>

                                    </td>
                                    <td style="display: flex; justify-content: right">
                                            <button class="editButton" wire:click.prevent="editOffer({{$offer}})" wire:key="edit.{{$offer->id}}">{{trans('accounting.buttons.edit')}}</button>
                                        <button class="detailsButton" wire:click.prevent="showOffer({{$offer}})" wire:key="show.{{$offer->id}}">{{trans('accounting.buttons.show')}}</button>
                                    </td>
                                </tr>
                            @endforeach
                    </div>
                    </tbody>
                </table>
                    <div class="paginate">
                        <button wire:click.prevent="gotToPage(1)"> <<</button>
                        <button wire:click.prevent="previousPage()"> <</button>
                        @for ($i = $fp; $i < $lp; $i++)
                            <button wire:click.prevent="gotToPage({{$i}})" wire:key="{{$i}}">{{$i}}</button>
                        @endfor
                        <button wire:click.prevent="nextPage()"> ></button>
                        <button wire:click.prevent="gotToPage({{$offers->lastPage()}})"> >></button>
                    </div>
                </x-index-table>
            </div>
        </div>
</div>
