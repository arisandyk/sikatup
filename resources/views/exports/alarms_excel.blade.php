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
                <td>{{ $alarm->date_log }}</td>
                <td>{{ $alarm->locations->address ?? 'Unknown Location' }}</td>
                <td>{{ $alarm->locations->gardu_induks->name ?? 'Unknown Gardu Induk' }}</td>
                <td>{{ $alarm->events->bays->name ?? 'Unknown Device' }}</td>
                <td>{{ $alarm->event_type ?? 'Unknown Event' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>