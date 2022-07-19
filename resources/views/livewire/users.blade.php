<x-app-layout>
    <x-slot name="header">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <button onclick="Livewire.emit('openModal', 'create-user')" class="btn btn-info">{{trans('users.general.new')}}</button>
        </div>
    </x-slot>
    <x-index-table>
        <table class="table table-striped table-sm data-table table-hover" id="users_table">
            <thead class="thead">
            <tr>
                <th>Nr.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Rolle</th>
                <th>Zusatzrechte</th>
                <th>{!! trans('users.index.actions') !!}</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </x-index-table>
    <script src="{{asset('js/shdw/users.datatables.js')}}"></script>
</x-app-layout>
