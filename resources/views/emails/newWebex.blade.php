<!doctype html>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Neuer Workshop erstellt!</title>
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

        <div class="default-style">Liebe/r {{$trainer->first_name}},<br>
        </div>
    </div>


    <div><br></div>
    <div>
        Sie haben am <strong>{{$webex->start_date}}</strong> um <strong>{{$webex->start}}</strong> ein Onlinetraining mit dem Titel <strong>{{$webex->title}}</strong> für tangensQ.<br><br>
        <table class="GeneratedTable" id="workshops_table">
            <thead>
            <tr>
               <th>Titel:</th>
                <th>Datum:</th>
                <th>Uhrzeit:</th>
                <th>Chatroom:</th>
                <th>Webex Link:</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{$webex->title}}</td>
                <td> {{$webex->start_date}}</td>
                <td> {{$webex->start}} bis {{$webex->end}}</td>
                <td>{{$webex->chatroom}}</td>
                <td><form>
                    <button type="submit" formaction="{{ $webex->webLink }}">Click me</button>
                    </form>
                    <button type="button" href="{{$webex->webLink}}">{!!   Html::link("$webex->webLink", "Meeting Starten") !!}</button>
                    <a href="{{ $webex->webLink }}" class="button" data-toggle="tooltip" data-placement="top" title="{{ trans('workshops.tooltips.back-workshops') }}">WebEx</a>
                    </td>
            </tr>
            </tbody>

        </table>
    </div>
    <div><br></div>
    <div><br></div>
    <div>
        <strong>Wichtig!</strong><br>
        <strong>Loggen Sie sich bitte bei WebEx über einen Browser (z.B. : Google Chrome, FireFox, Internet Explorer/Microsoft Edge) an und <b>nicht</b> über die WebEx App. </strong>
        Um das Webinar starten zu können nutzen Sie bitte folgende Login Daten :<br><br>
        @if ($webex->chatroom == 1)
            Emailadresse : <strong>onlinetrainingeins@tangensq.de</strong><br>
            Passwort : <strong>OnLinetangens1335&20 </strong>  (Bitte das Passwort eintippen und nicht mit copy & paste einfügen)<br><br>
        @endif
        @if ($webex->chatroom == 2)
            Emailadresse : <strong>onlinetrainingzwei@tangensq.de</strong><br>
            Passwort : <strong>OnLinetangens2335&20 </strong>  (Bitte das Passwort eintippen und nicht mit copy & paste einfügen)<br><br>
        @endif

        Nun befinden Sie sich auf der Gastgeberseite und können das Meeting starten.<br>
        Wenn Sie CiscoWebex (<a href="www.webex.com">www.webex.com</a>) noch nicht kennen, vereinbaren Sie gern einen Termin mit uns, zu dem wir Ihnen ein Probeseminar einrichten. <br>
        Dann können Sie das ganze Prozedere noch einmal in Ruhe durchgehen.<br>
        Bei Rückfragen wenden Sie sich gern an uns!<br><br><br>

        {{--                TODO  General Signature or User Signature--}}
        ------------
        ...ALLGEMEINE SIGNATUR ANZEIGEN ODER MITARBEITER SPEZIFISCH...

        ------------
    </div>
</body>
</html>
