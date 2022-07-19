<table>
    <thead>
    <tr style="font-weight: bold">
        <th>Nachname</th>
        <th>Vorname</th>
        <th>Email</th>

        <th>Telefon</th>

    </tr>
    </thead>
    <tbody>
    @foreach($staff as $client)
        <tr>
            <td>{{ $client['last_name'] }}</td>
            <td>{{ $client['first_name'] }}</td>
            <td>{{ $client['email'] }}</td>
            <td>{{ $client['phone'] }}</td>

        </tr>
    @endforeach
    </tbody>
</table>
