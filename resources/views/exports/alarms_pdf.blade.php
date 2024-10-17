<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Alarms Export</title>
    <style>
        @font-face {
            font-family: 'DejaVu Sans';
            src: url('/path/to/DejaVuSans.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Alarms Export</h1>
    <table>
        <thead>
            <tr>
                <th>Date Log</th>
                <th>Location</th>
                <th>Gardu Induk</th>
                <th>Bay</th>
                <th>Event</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alarms as $alarm)
                <tr>
                    <td>{{ $alarm['date_log'] }}</td>
                    <td>{{ $alarm['location'] }}</td>
                    <td>{{ $alarm['gardu_induk'] }}</td>
                    <td>{{ $alarm['bay'] }}</td>
                    <td>{{ $alarm['event_type'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>