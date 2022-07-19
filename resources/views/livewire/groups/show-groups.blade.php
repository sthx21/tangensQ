<div>

    <x-slot name="header">
         <div class="lg:px-8" id="heads">
        </div>
    </x-slot>

        <div class="row">
            <div class="col-md-10 col-12 w-full">
            <div class="tableTopMenu">
                <div>

                        <button onclick="Livewire.emit('openModal', 'groups.create-company-group')" class="createReminderButton">{{trans('companies.groups.new')}}</button>

                </div>
                <div class="tableTopRight">

                    <div>
                    <x-shdw-input name="filter" label="Filtern.."/>
                    </div>
                </div>
            </div>
                <x-index-table>
                <table class="table table-striped table-sm data-table table-hover groupTable" id="companies_table">

                    <thead>
                    <tr class="border-black">
                        <th class="tableHeader" wire:click.prevent="sorting('id')">Nr.</th>
                        <th class="tableHeader" wire:click.prevent="sorting('name')">{!! trans('companies.groups.name') !!}</th>
                        <th class="tableHeader">{!! trans('companies.groups.members') !!}</th>
                        <th style="text-align: center" class="tableHeader">{!! trans('companies.index.actions') !!}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <div>
                            @foreach ($groups as $group)
                                <tr>
                                    <td>{{$group->id}}</td>
                                    <td>{{$group->name}}</td>
                                    <td>
                                        @foreach($group->companies as $member)
                                          <span class="badge badge-pill badge-success">  {{$member->name}}</span>

                                        @endforeach
                                        </td>
                                    <td style="display: flex; justify-content: right">
                                        <button onclick="Livewire.emit('openModal', 'groups.edit-company-group', {{ json_encode(["groupId" => $group->id]) }})" class="editButton">{{trans('companies.groups.edit')}}</button>
                                        <button onclick="Livewire.emit('openModal', 'groups.show-company-group', {{ json_encode(["groupId" => $group->id]) }})" class="detailsButton">{{trans('companies.groups.show')}}</button>

{{--                                        <button class="detailsButton" wire:click.prevent="showCompany({{$group}})" wire:key="show.{{$group->id}}">Details</button>--}}
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
                        <button wire:click.prevent="gotToPage({{$groups->lastPage()}})"> >></button>
                    </div>
                </x-index-table>
            </div>
        </div>
</div>
