<x-modal-user form-action="update">
    <x-slot name="title">
        <div class="d-flex justify-content-between">
            <div>
                {!! trans('companies.groups.edit') !!}
            </div>

            <div>
                <button class="removeButton" name="deleteButton" wire:click.prevent="confirmDelete()">{{trans('companies.buttons.delete')}}</button>

            </div>
        </div>
    </x-slot>
    <x-slot name="content">
        <div>
        <div class="card">
            {!! csrf_field() !!}

            <div class="m-4">
                <x-shdw-input name="group.name" :label="trans('companies.groups.name')"/>

            </div>
            <div class="row m-4">
                <div class="col-12 col-md-6">
                    <x-shdw-input name="group.discount" :label="trans('companies.groups.discount')"/>
                </div>
                <div class="col-12 col-md-6">
                    <x-shdw-input type="date" name="group.discount_until" :label="trans('companies.groups.discount_until')"/>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-4"><h5>{{trans('companies.groups.members')}}</h5></div>
            <div  style="margin: 16px">
            @foreach($members as $member)
                <div class="memberButton" wire:click.prevent="removeMember({{$member['id']}})" wire:key="tagFilter{{$member['id']}}">
                    {{$member['name']}}
                </div>
            @endforeach
            </div>
            <div>
                <div>
                    <x-shdw-input name="addMember" label="Unternehmen hinzufügen"/>

                </div>
                <div>
                    @if ($allMembers)
                        <ul class="searchResults">
                            @foreach($allMembers as $member)
                                <li wire:click.prevent="addMember({{$member->id}})">{{ $member->name }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

        </div>
        </div>
    </x-slot>
    <x-slot name="buttons">
        <button type="submit" class="storeButtonBig">{{trans('companies.groups.save')}}</button>
    </x-slot>

</x-modal-user>

