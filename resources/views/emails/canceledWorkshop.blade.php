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

        <div class="default-style">Hallo
            @if (isset($trainer))
                {{$trainer->first_name}},
            @endif
            @if (isset($client))
                {{$client->first_name.' '.$client->last_name}},
            @endif
            <br>


        </div>
    </div>


    <div><br></div>
    <div>
        <strong>Der Workshop {{$workshop->title}} wurde gecanceled.<br></strong><br>
        <table class="GeneratedTable" id="workshops_table">
            <thead>
            <tr>
               <th>Titel:</th>
                <th>Datum:</th>
                <th>Location:</th>

            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{$workshop->title}}</td>
            <td> {{$workshop->start_date}}</td>
            <td>{{$workshop->location}}</td>

            </tr>
            </tbody>

        </table>



    </div>

</body>
</html>
