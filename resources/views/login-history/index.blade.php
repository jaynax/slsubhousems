@extends('layouts.users.index')

@section('content')
<div class="container">
    <h1>Login History</h1>
    <p>This will show login history for: <strong>{{ $user->name }}</strong></p>

    <div class="table-responsive mt-4">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>IP Address</th>
                    <th>Login Date & Time</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loginHistories as $index => $history)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $history->ip_address }}</td>
                        <td>{{ \Carbon\Carbon::parse($history->login_at)->format('M d, Y h:i A') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No login history available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
