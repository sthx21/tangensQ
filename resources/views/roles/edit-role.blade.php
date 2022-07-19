<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <x-index-create>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>{{trans('roles.edit.role')}}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('roles.index') }}"> {{trans('roles.buttons.backToRoles')}}</a>
        </div>
    </div>
</div>

@if (count($errors) > 0)
    <div class="alert alert-danger" >
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

{{--        {!! Form::open(array('route' => ['roles.update', $role-], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation')) !!}--}}
{!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
<div class="row">
    <div class="col-2">
        <div class="form-group">
            <strong>{{trans('roles.edit.name')}}</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="row pb-4 pl-2">
        <div class="col-6 pt-3">
{{--            TODO Translations--}}
            <strong>Rechte:</strong>
            <table class="table">
                <thead>
                <tr>
                    <th id="permissionName">{{trans('permissions.edit.name')}}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

        </div>
        <div class="col-6 pt-3 id_99" id="id_99">
            <select class="managePermissions" id="managePermissions" name="permissions[]" style="width: 70%">
            </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        @if($role->id === 4)
        <button type="submit" class="btn btn-primary disabled" tooltip="{{trans('roles.general.cant')}}">{{trans('roles.buttons.saveChanges')}}</button>
        @else
            <button type="submit" class="btn btn-primary " tooltip="{{trans('roles.general.cant')}}">{{trans('roles.buttons.saveChanges')}}</button>
        @endif
    </div>
</div>
{!! Form::close() !!}
</x-index-create>
    <script type="text/javascript">
{{--var perms= @json($rolePermissions);--}}
// Set up the Select2 control
$('#managePermissions').select2({
    multiple: 'multiple',
    theme: 'bootstrap-5',
    ajax: {
        url: '/managePermissions',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: $.map(data, function (item) {
                    return {
                        text: item.name,
                        id: item.id
                    }

                })
            };
        },
        cache: true
    }
});
// console.log($('#managePermissions').select2());

// Fetch the preselected item, and add to the control
var permissions = $('#managePermissions');
var roleId = <?php echo $role->id ?>;
$.ajax({
    type: 'GET',
    url: '/selectedPermissions/' + roleId
}).then(function (data) {
    let numberSelected = 0;
    for (let i = 0; i < data.length; i++) {
        var option = new Option(data[i].name, data[i].id, true, true);
        permissions.append(option).trigger('change');
        numberSelected++;
        }
    // manually trigger the `select2:select` event
    permissions.trigger({
        type: 'select2:select',
        params: {
            data: data
        }
    });
});

    </script>
</x-app-layout>
