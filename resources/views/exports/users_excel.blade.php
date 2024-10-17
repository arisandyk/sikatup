<!DOCTYPE html>
<html>

<head>
    <title>Users Excel</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Role</th>
                <th>Unit Induk</th>
                <th>App</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->unit_name }}</td>
                    <td>{{ $user->app_name }}</td>
                    <td>{{ $user->account_status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
