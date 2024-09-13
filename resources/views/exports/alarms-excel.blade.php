<table>
    <thead>
        <tr>
            <th>Date Log</th>
            <th>Location</th>
            <th>Device</th>
            <th>Event</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($alarms as $alarm)
        <tr>
            <td>{{ \Carbon\Carbon::parse($alarm->date_log)->format('d-m-Y H:i') }}</td>
            <td>{{ $alarm->locations->address ?? 'Unknown Location' }}</td>
            <td>{{ $alarm->events->bays->name ?? 'Unknown Device' }}</td>
            <td>{{ $alarm->event_type ?? 'Unknown Event' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>