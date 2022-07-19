<div>
    <x-slot name="header">
        <div class="lg:px-8" id="heads">
            <x-button-link :link="'/clients/create'" :class="'btn-info'" :title="'New Company'">{{trans('trainers.buttons.new')}}</x-button-link>
        </div>
    </x-slot>
    <div class="row">
        <div class="col-md-9 col-12 w-full">
            <div class="tableTopMenu">
                <div>
                    <x-shdw-select name="paginateNo" label="" wire:model="paginateNo">
                        <option value="22">25</option>
                        <option value="45">50</option>
                        <option value="100">100</option>
                        <option value="9999">All</option>
                    </x-shdw-select>
                </div>
                <div class="tableTopRight">
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                    <div class="exportMenu">Export</div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>
                            <x-slot name="content"  style="width: fit-content">
                                <button name="export" class="exportToExcel" wire:click.prevent="exportToExcel()">Excel</button>
                                <button name="export" class="exportToExcel" wire:click.prevent="exportToPdf()">PDF</button>
                                <button name="export" class="exportToExcel" wire:click.prevent="exportPrint()">Drucken</button>
                            </x-slot>
                        </x-dropdown>
                    </div>
                <x-shdw-input name="postalCodeFilter" label="PLZ Filter"/>
                <x-shdw-input name="filter" label="Filtern.."/>
                    </div>
                </div>
            <x-index-table>
                <table class="table table-striped table-sm data-table table-hover" id="companies_table">
                    <thead>
                    <tr  class="border-black">
                        <th>

                        </th>
                        <th></th>

                        <th >

                        </th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <thead>
                    <tr class="border-black">
                        <th class="tableHeader" wire:click.prevent="sorting('id')">Nr.</th>
                        <th class="tableHeader" wire:click.prevent="sorting('last_name')">{!! trans('trainers.index.lastName') !!}</th>
                        <th class="tableHeader" wire:click.prevent="sorting('first_name')">{!! trans('trainers.index.firstName') !!}</th>
                        <th class="tableHeader" wire:click.prevent="sorting('email')">{!! trans('trainers.index.email') !!}</th>
                        <th class="tableHeader" wire:click.prevent="sorting('position')">{!! trans('trainers.index.position') !!}</th>

                        <th></th>
                        <th style="text-align: center" class="tableHeader">{!! trans('trainers.index.actions') !!}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <div>

                        @foreach ($tagFilteredClients as $client)
                            <tr>
                                <td>{{$client->id}}</td>
                                <td>{{$client->last_name}}</td>
                                <td>{{$client->first_name}}</td>
                                <td>{{$client->email}}</td>
                                <td>{{$client->position}}</td>
                                <td></td>
                                <td style="display: flex; justify-content: right"><button class="editButton" wire:click.prevent="editClient({{$client}})" wire:key="edit.{{$client->id}}">Bearbeiten</button>
                                    <button class="detailsButton" wire:click.prevent="showClient({{$client}})" wire:key="show.{{$client->id}}">Details</button>
                                </td>
                            </tr>
                        @endforeach
                    </div>
                    </tbody>
                </table>
                <div class="paginate">
                    <button wire:click.prevent="previousPage()"> <</button>
                    @for ($i = 1; $i < $lastPage; $i++)
                        <button wire:click.prevent="paginationPage({{$i}})" wire:key="{{$i}}">{{$i}}</button>
                    @endfor
                    <button wire:click.prevent="nextPage()"> ></button>
                </div>
            </x-index-table>
        </div>
        @include('components.right-menu')
    </div>s
</div>
