<x-modal-user>
    <x-slot name="title">
        <div class="d-flex justify-content-between">
            {!! trans('companies.groups.edit') !!}

        </div>
    </x-slot>
    <x-slot name="content">
        <div class="card">
            {!! csrf_field() !!}

            <div class="m-4">
                <x-shdw-input name="group.name" :label="trans('companies.groups.name')" disabled=""/>

            </div>
            <div class="row m-4">
                <div class="col-12 col-md-6">
                    <x-shdw-input name="group.discount" :label="trans('companies.groups.discount')" disabled=""/>
                </div>
                <div class="col-12 col-md-6">
                    <x-shdw-input type="date" name="group.discount_until" :label="trans('companies.groups.discount_until')" disabled=""/>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-4"><h5>{{trans('companies.groups.members')}}</h5></div>
            <div  style="margin: 16px">
            @foreach($members as $member)
                <div class="memberButton">
                    {{$member['name']}}
                </div>
            @endforeach
            </div>

        </div>
    </x-slot>
    <x-slot name="buttons">
    </x-slot>
</x-modal-user>

