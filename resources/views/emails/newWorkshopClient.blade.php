<!doctype html>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Neue Workshops wurden erstellt!</title>
    <style type="text/css" scoped>
        table.GeneratedTable {
            width:100%;
            background-color:#FFFFFF;
            font-family:inherit;
            border-collapse:collapse;
            border-width:3px;
            border-color:#7e916b;
            border-style:solid;
            color:#303030;
        }

        table.GeneratedTable td, table.GeneratedTable th {
            border-width:3px;
            border-color:#7e916b;
            border-style:solid;
            padding:5px;
        }

        table.GeneratedTable thead {
            background-color:#D0D3D4;
        }
    </style>
</head>
<body>

    <div class="io-ox-signature">

        <div class="default-style">Hallo {{$trainer->first_name}},<br>


        </div>
    </div>


    <div><br></div>
    <div>

        <strong>Die aktuelle Teilnehmerliste :<br></strong>
        <table class="GeneratedTable" id="workshops_table">
            <thead>
            <tr>
               <th>{{trans('clients.labels.firstName')}}</th>
                <th>{{trans('clients.labels.lastName')}}</th>
                <th>{{trans('clients.labels.company')}}</th>

            </tr>
            </thead>
            <tbody>
            @foreach ($clients as $client)
                <tr>
                    <td>{{$client->first_name}}</td>
                    <td>{{$client->last_name}}</td>
                    <td>{{$client->company->name}}</td>
                </tr>
            @endforeach

            </tbody>

        </table>



    </div>

</body>
</html>
