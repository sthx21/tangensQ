<div>
    <x-slot name="header">
         <div class="lg:px-8" id="heads">
        </div>
    </x-slot>

        <div class="row">
            <div class="col-md-12 col-12 w-full">
            <div class="tableTopMenu">

                <div style="width: 100px">
                    <x-shdw-select name="paginateNo" label="" wire:model="paginateNo">
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="500">500</option>
                    </x-shdw-select>
                </div>
                <div class="tableTopRight">
                    <a href="{{route('workshops.create')}}"><button class="createReminderButton">{{trans('workshops.buttons.new')}}</button> </a>
                    <div style="width: 100px">
                        <x-shdw-select name="regionFilter" label="Region" wire:model="regionFilter">
                            <option value="">Alle</option>
                            @foreach ($regions as $region)
                                <option value="{{$region}}">{{$region}}</option>
                            @endforeach
                        </x-shdw-select>
                    </div>

{{--                    <x-shdw-input name="postalCodeFilter" label="PLZ Filter"/>--}}
                    <x-shdw-input name="filter" label="Filtern.."/>
                </div>
            </div>
                <x-index-table>
                <table class="table table-striped table-sm data-table table-hover" id="workshops_table">

                    <thead>
                    <tr class="border-black">
                        <th class="tableHeader" wire:click.prevent="sorting('id')">Nr.</th>
                        <th class="tableHeader" wire:click.prevent="sorting('title')">{!! trans('workshops.show.title') !!}</th>
                        <th class="tableHeader" wire:click.prevent="sorting('start_date')">{!! trans('workshops.show.startDate') !!}</th>
                        <th class="tableHeader" wire:click.prevent="sorting('end_date')">{!! trans('workshops.show.endDate') !!}</th>
                        <th class="tableHeader">{!! trans('workshops.show.trainer') !!}</th>
                        <th class="tableHeader" wire:click.prevent="sorting('region')">{!! trans('workshops.show.location') !!}</th>
                        <th class="tableHeader" wire:click.prevent="sorting('region')">{!! trans('workshops.show.region') !!}</th>
                        <th class="tableHeader">{!! trans('workshops.show.series') !!}</th>
                        <th style="text-align: center" class="tableHeader">{!! trans('companies.index.actions') !!}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <div>
                            @foreach ($tagFilteredWorkshops as $workshop)
                                <tr style="@if($workshop->canceled) background-color: red; @endif">
                                    <td>{{$workshop->id}}</td>
                                    <td>{{$workshop->title}}</td>
                                    <td>{{$workshop->start_date}}</td>
                                    <td>{{$workshop->end_date}}</td>
                                    <td>
                                        @foreach ($workshop->trainers as $trainer)
                                            {{$trainer->last_name}}<br>
                                        @endforeach
                                    </td>
                                    <td>{{$workshop->location}}</td>
                                    <td>{{$workshop->region}}</td>
                                    <td>SERIEBUTTON</td>
                                    <td style="display: flex; justify-content: right; ">
                                        <button class="editButton" wire:click.prevent="editWorkshop({{$workshop}})" wire:key="edit.{{$workshop->id}}">{{trans('workshops.buttons.edit')}}</button>
                                        <button class="detailsButton" wire:click.prevent="showWorkshop({{$workshop}})" wire:key="show.{{$workshop->id}}">{{trans('workshops.buttons.show')}}</button>
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
                        <button wire:click.prevent="gotToPage({{$tagFilteredWorkshops->lastPage()}})"> >></button>
                    </div>
                </x-index-table>
            </div>
        </div>
</div>
