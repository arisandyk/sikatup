<div class="container-request">
    <h3>Your Requests</h3>
    @if ($requests->isEmpty())
        <p>You have not made any requests yet.</p>
    @else
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Request Type</th>
                                <th>Old Value</th>
                                <th>New Value</th>
                                <th>Status</th>
                                <th>Admin Response</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requests as $request)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ ucfirst($request->request_type) }}</td>
                                    <td>{{ $request->old_value }}</td>
                                    <td>{{ $request->new_value }}</td>
                                    <td>{{ ucfirst($request->status) }}</td>
                                    <td>{{ $request->admin_response ?? 'N/A' }}</td>
                                    <td>{{ $request->created_at->format('d-m-Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
