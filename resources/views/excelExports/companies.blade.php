<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Mitarbeiter</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody>
    @foreach($companies[0] as $company)
        <tr>
            <td>{{ $company['name'] }}</td>
            <td>{{ $company['main_email'] }}</td>
        </tr>
      @foreach($company['staff'] as $staff)
        <tr>
            <td></td>
            <td></td>
                    @if ($staff['active'] === 1 )
                    <td>{{$staff['last_name']}}</td>
                    <td>{{$staff['email']}}</td>
                @endif
        </tr>
            @endforeach

    @endforeach
    </tbody>
</table>
