<x-app-layout>
    <x-slot name="header">
        @can('create roles')
            <div>
                <a class="btn btn-info" href="{{ route('roles.create') }}"> {{trans('roles.buttons.createNew')}}</a>

            </div>
        @endcan
    </x-slot>
    <x-index-table>



@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif


<table class="table table-bordered">
  <tr>
     <th>{{trans('roles.index.number')}}</th>
     <th>{{trans('roles.index.name')}}</th>
      <th>{{trans('roles.index.permissions')}}</th>
      <th>{{trans('roles.index.status')}}</th>
     <th width="400px">{{trans('roles.index.actions')}}</th>
  </tr>
    @foreach ($roles as $key => $role)
    <tr>
        <td>{{ ++$i }}</td>
        <td><h4> <span class="badge badge-info">{{ $role->name }}</span></h4>
        </td>

        <td>
            @foreach($role->permissions as $permission)
                <span class="badge badge-success">{{ $permission->name }}</span>
            @endforeach
            </td>
        <td>
            @can('edit roles')
            <input data-id="{{$role->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Aktiv" data-off="Inaktiv" {{ $role->status ? 'checked' : '' }}></td>
        @endcan
        @cannot('edit roles')
            @if ($role->status == 1)
                Aktiv
            @else
                Inaktiv
            @endif
        @endcannot
        <td>
            <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">{{trans('roles.buttons.show')}}</a>
            @can('edit roles')
                <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">{{trans('roles.buttons.edit')}}</a>
            @endcan
            @can('delete roles')
                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                    {!! Form::submit(trans('roles.buttons.delete'), ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            @endcan
        </td>
    </tr>
    @endforeach
</table>
    </x-index-table>
    <script>
        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') === true ? 1 : 0;
                var role_id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/changeStatus',
                    data: {'status': status, 'role_id': role_id},
                    success: function(data){
                        console.log(data.success)
                    }
                });
            })
        })
    </script>
</x-app-layout>
