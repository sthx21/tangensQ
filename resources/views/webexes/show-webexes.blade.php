<x-app-layout>
    <x-slot name="header">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8" id="heads">
            <x-button-link :link="'/webex/create'" :class="'btn-info'" :title="trans('workshops.tooltips.new')">{{trans('workshops.buttons.new')}}</x-button-link>
        </div>
    </x-slot>
    <style>
        div.dataTables_length {
            width: 250px;
        }
    </style>
            <x-index-table>
                <table class="table table-striped table-sm data-table table-hover" id="workshops_table">
                                <thead>
                                <tr  class="border-black">
                                    <th>Nr.</th>
                                    <th>{{trans('workshops.index.title')}}</th>
                                    <th>{{trans('workshops.index.date')}}</th>
                                    <th>{{trans('workshops.index.begin')}}</th>
                                    <th>{{trans('workshops.index.end')}}</th>
                                    <th>{{trans('workshops.index.clientCount')}}</th>
                                    <th>{{trans('workshops.index.status')}}</th>
                                    <th>{!! trans('workshops.index.actions') !!}</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                </table>
                <script type="text/javascript">
                    $(document).ready(function () {
                        var table = $('#workshops_table').DataTable({

                            fixedHeader: {
                                header: true,
                                footer: true
                            },
                            colReorder: {
                                realtime: false
                            },
                            pageLength: 25,
                            lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Alle"] ],
                            processing: true,
                            serverSide: true,
                            stateRestore: true,
                            select: true,
                            info: true,
                            language: {
                                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json",
                                select: {
                                    rows: {
                                        _: " %d Zeilen ausgewählt",
                                        0: "Zeile zum Auswählen anklicken.",
                                        1: "Eine Zeile ausgewählt"
                                    }
                                },
                                buttons: {
                                    renameState: 'Umbenennen',
                                    removeState: 'Löschen',
                                    copy: 'In die Zwischenablage kopieren',
                                    pdf: 'Als PDF',
                                    selectNone: 'Aufheben',
                                    excel: 'Als Excel Tabelle'
                                },
                                colvis: "Sichtbarkeit"
                            },
                            ajax: "{{ route('webexes.list') }}",

                            columnDefs : [
                                { "width": "5%", "targets": 0 },
                                { "width": "10%", "targets": 2 },
                                { "width": "10%", "targets": 3 },
                                { "width": "5%", "targets": 4 },
                                { "width": "5%", "targets": 5 },
                                { "width": "10%", "targets": 6 },
                                { "width": "20%", "targets": 7 },

                            ],
                            dom: 'lBrftip',
                            buttons: [

                                {
                                    extend: 'all',
                                    text: 'Alle',

                                },
                                {
                                    extend: 'online',
                                    text: 'Online'
                                },
                                {
                                    extend: 'inactive',
                                    text: 'Inaktiv'
                                },
                                {
                                    extend: 'ended',
                                    text: 'Beendet'
                                },
                                {
                                    extend: 'canceled',
                                    text: 'Storniert'
                                },
                            ],
                            columns: [
                                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                                {data: 'title', name: 'title'},
                                {data: 'start_date', name: 'start_date'},
                                {data: 'start', name: 'start',},
                                {data: 'end', name: 'end'},
                                {data: 'booked', name: 'booked',
                                    render : function (data, type, row) {
                                        if (data >= 10) {
                                            return '<h4><span class="badge badge-success">' +data+ '</span></h4>'

                                        }
                                        if(data >3 && data < 10) {
                                            return '<h4><span class="badge badge-warning">' + data + '</span></h4>'

                                        }
                                        else {
                                            return '<h4><span class="badge badge-danger">' + data + '</span></h4>'

                                        }
                                    }
                                },
                                {data: 'state', name: 'state',
                                    render : function (data, type, row) {
                                    if (data == 'Inaktiv') {
                                        return '<h4><span class="badge badge-primary">' +data+ '</span></h4>'

                                    }
                                    if(data == 'Storniert') {
                                        return '<h4><span class="badge badge-danger">' + data + '</span></h4>'

                                    }
                                    else {
                                        return '<h4><span class="badge badge-success">' + data + '</span></h4>'

                                    }
                                    }
                                    },

                                {
                                    data: 'action',
                                    name: 'Aktionen',

                                    orderable: true,
                                    searchable: true
                                },


                            ],


                        });
                        $.fn.dataTable.ext.buttons.online = {
                            className: 'buttons-online',


                            action: function () {
                                table.column(5).search('Online').draw();
                            }
                        };
                        $.fn.dataTable.ext.buttons.ended = {
                            className: 'buttons-ended',

                            action: function () {
                                table.column(5).search('Beendet').draw();
                            }
                        };
                        $.fn.dataTable.ext.buttons.all = {
                            className: 'buttons-all',

                            action: function () {
                                table.column(5).search('').draw();
                            }
                        };

                        $.fn.dataTable.ext.buttons.canceled = {
                            className: 'buttons-canceled',

                            action: function () {
                                table.column(5).search('Storniert').draw();
                            }
                        };
                        $.fn.dataTable.ext.buttons.inactive = {
                            className: 'buttons-inactive',

                            action: function () {
                                table.column(5).search('Inaktiv').draw();
                            }
                        };
                        addTableButtons();

                    });
                    function addTableButtons() {
                        var table = $('#workshops_table').DataTable();

                        new $.fn.dataTable.Buttons( table, {
                            buttons: [
                                'selectNone',
                                {
                                    extend: 'collection',
                                    text: 'Export',
                                    className: "btnArrow",
                                    buttons: [
                                        { extend: "print",
                                            text: 'Drucken',
                                            exportOptions: {
                                                columns: [0,1,2,3,4,5,6], rows: ':visible' }
                                        },
                                        { extend: "pdf",
                                            exportOptions: {
                                                columns: [0,1,2,3,4,5,6], rows: ':visible' }
                                        }
                                        ,
                                        { extend: "excel",
                                            exportOptions: {
                                                columns: [0,1,2,3,4,5,6], rows: ':visible' }
                                        },
                                        { extend: "copy",
                                            exportOptions: {
                                                columns: [0,1,2,3,4,5,6], rows: ':visible' }
                                        }

                                    ] },
                                {
                                    extend: 'colvis',
                                    text: 'Sichtbarkeit',
                                },
                                {
                                    extend: 'createState',
                                    text: 'Speichern',
                                },
                                {
                                    extend: 'savedStates',
                                    text: 'Profile',
                                    config: {
                                        // Your config goes here
                                    }
                                }
                            ] }
                        );

                        table.buttons( 0, null ).containers().appendTo( '#heads' );
                    }

                </script>
            </x-index-table>




</x-app-layout>

