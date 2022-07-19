    $(function () {
    var table = $('#users_table').DataTable({
    pageLength: 25,
    processing: true,
    serverSide: true,
    language: {
    url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
},
    ajax: "{{ route('users.list') }}",
    columnDefs : [
{ "width": "5%", "targets": 0 },
{ "width": "10%", "targets": 3 },
{ "width": "40%", "targets": 4 },
{ "width": "15%", "targets": 5 },
    ],
    columns: [
{data: 'DT_RowIndex', name: 'DT_RowIndex'},
{data: 'name', name: 'name'},
{data: 'email', name: 'email'},
{data: 'roles',
    name: 'user.name',
    render : function (data, type, row) {
    return '<span class="badge badge-primary">'+data+'</span><br>'
}
},
{data: 'roles',
    name: 'user.permissions',
    render : function (data, type, row) {
    return '<span class="badge badge-primary">'+data+'</span><br>'
}
},
{
    data: 'action',
    name: 'Aktionen',
    orderable: true,
    searchable: true
},
    ]
});
});
