<x-app-layout>
    <x-slot name="header">


    </x-slot>

    <x-index-table>
                <div class="content table-reposive table-full-width">
                    <table class="table table-striped table-sm data-table table-hover" id="accounting_table">
                        <thead>
                            <tr>
                                <th>
                                    CheckBox
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    Description
                                </th>
                                <th>
                                    DueDate
                                </th>
                                <th>
                                    Amount
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
    </x-index-table>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#accounting_table').DataTable({
                pageLength: 25,
                processing: true,
                serverSide: true,
                language: {
                    url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
                },
                ajax: "{{ route('getOffers') }}",
                columnDefs : [
                    { "width": "5%", "targets": 0 },
                    { "width": "5%", "targets": 1 },
                    { "width": "40%", "targets": 2 },
                    { "width": "10%", "targets": 3 },
                    { "width": "10%", "targets": 4 },
                    { "width": "20%", "targets": 5 },
                    {
                        data: null,
                        defaultContent: '',
                        orderable: false,
                        className: 'select-checkbox',
                        targets:   0
                    }
                ],
                select: {
                    style:    'os',
                    // selector: 'td:first-child',
                    toggleable: true
                },
                columns: [
                    {data: null, name: null},
                    {data: 'progress', name: 'progress'},
                    {data: 'offer_number', name: 'offer_number'},
                    {data: 'valid_until', name: 'valid_until'},
                    {data: 'total', name: 'total'},
                    {
                        data: 'action',
                        name: 'Aktionen',
                        orderable: true,
                        searchable: true
                    },
                ]
            });
            table.row(2).select();
        });
    </script>
</x-app-layout>

