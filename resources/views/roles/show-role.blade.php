<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <x-index-create>

    <div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> {{trans('roles.labels.show')}}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('roles.index') }}"> {{trans('roles.buttons.backToRoles')}}</a>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-3">
        <div class="form-group">
            <strong>{{trans('roles.labels.name')}}</strong>
            <h4> <span class="badge badge-info">{{ $role->name }}</span></h4>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>{{trans('roles.labels.permissions')}}</strong><br>
            @if(!empty($rolePermissions))
                @foreach($rolePermissions as $v)
                   <h4 class="badge badge-success">{{ $v->name }}</h4>
                @endforeach
            @endif
        </div>
    </div>
</div>
    </x-index-create>

</x-app-layout>
