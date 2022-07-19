<x-modal-user form-action="createGroup">
    <x-slot name="title">
        <div class="d-flex justify-content-between">
            {!! trans('companies.groups.new') !!}

        </div>
    </x-slot>
    <x-slot name="content">
        <div class="card">
            {!! csrf_field() !!}

            <x-shdw-input name="group.name" :label="trans('companies.groups.name')"/>
            <div class="row">
                <div class="col-12 col-md-6">
                    <x-shdw-input name="group.discount" :label="trans('companies.groups.discount')"/>
                </div>
                <div class="col-12 col-md-6">
                    <x-shdw-input type="date" name="group.discount_until" :label="trans('companies.groups.discount_until')"/>
                </div>
            </div>
        </div>
    </x-slot>
    <x-slot name="buttons">
        <button type="submit" class="storeButtonBig">{{trans('users.general.new')}}</button>
    </x-slot>
</x-modal-user>

