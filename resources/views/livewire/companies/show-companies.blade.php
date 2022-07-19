<div>

    <x-slot name="header">
         <div class="lg:px-8" id="heads">
        </div>
    </x-slot>

        <div class="row">
            <div class="col-md-9 col-12 w-full">
            <div class="tableTopMenu">

                <div>
                    <x-shdw-select name="paginateNo" label="" wire:model="paginateNo">
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="500">500</option>
                    </x-shdw-select>
                </div>
                <div class="tableTopRight">
                    <a href="{{route('companies.create')}}"><button class="createReminderButton">{{trans('companies.buttons.new')}}</button> </a>
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
                    <tr class="border-black">
                        <th class="tableHeader" wire:click.prevent="sorting('id')">Nr.</th>
                        <th class="tableHeader" wire:click.prevent="sorting('name')">{!! trans('companies.index.name') !!}</th>
                        <th class="tableHeader" wire:click.prevent="sorting('main_email')">{!! trans('companies.index.companyEmail') !!}</th>
                        <th class="tableHeader">{!! trans('companies.index.companyGroup') !!}</th>
                        <th></th>
                        <th style="text-align: center" class="tableHeader">{!! trans('companies.index.actions') !!}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <div>
                            @foreach ($tagFilteredCompanies as $company)
                                <tr>
                                    <td>{{$company->id}}</td>
                                    <td>{{$company->name}}</td>
                                    <td>{{$company->main_email}}</td>
                                    <td>{{$company->group()->first()->name ?? 'Ohne'}}</td>
                                    <td></td>
                                    <td style="display: flex; justify-content: right">
                                        <button class="editButton" wire:click.prevent="editCompany({{$company}})" wire:key="edit.{{$company->id}}">Bearbeiten</button>
                                        <button class="detailsButton" wire:click.prevent="showCompany({{$company}})" wire:key="show.{{$company->id}}">Details</button>
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
                        <button wire:click.prevent="gotToPage({{$tagFilteredCompanies->lastPage()}})"> >></button>
                    </div>
                </x-index-table>
            </div>
         @include('components.right-menu')
        </div>
</div>
