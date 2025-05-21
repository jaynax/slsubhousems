@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if(isset($tenants) && $tenants->count())
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Contact</th>
                <th>Status</th>
                <th>Room No.</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tenants as $tenant)
                <tr>
                    <td>{{ $tenant->user->name }}</td>
                    <td>{{ $tenant->user->email }}</td>
                    <td>{{ ucfirst($tenant->status) }}</td>
                    <td>{{ $tenant->room_number ?? 'N/A' }}</td>
                    <td>
                        @if($tenant->status === 'pending')
                            <form action="{{ route('tenant.approve', $tenant->id) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="text" name="room_number" placeholder="Room #" required class="form-control mb-1" />
                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                            </form>
                            <form action="{{ route('tenant.reject', $tenant->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        @else
                            <span class="badge bg-secondary">Processed</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No tenant applications yet.</p>
@endif
