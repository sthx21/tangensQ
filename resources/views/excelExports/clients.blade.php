<table>
    <thead>
    <tr style="font-weight: bold">
        <th>Nachname</th>
        <th>Vorname</th>
        <th>Email</th>
        <th>Zweitemail</th>
        <th>Telefon</th>
        <th>Zweittelefon</th>
    </tr>
    </thead>
    <tbody>
    @foreach($clients[0] as $client)
        <tr>
            <td>{{ $client['last_name'] }}</td>
            <td>{{ $client['first_name'] }}</td>
            <td>{{ $client['email'] }}</td>
            <td>{{$client->phone}}</td>
            <td>{{ $client['second_email'] }}</td>
            <td>{{$client['phone']}}</td>
            <td>{{$client['second_phone']}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
