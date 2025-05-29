@extends('layouts.boardinghouse.index')

@section('content')
<div class="container">
    <h2 class="mb-4">Tenant Applications</h2>

    <!-- Create Button -->
  

    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($tenants->isEmpty())
        <p>No tenant applications found.</p>
    @else
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Contact Number</th>
                    <th>Status</th>
                    <th>Room Number</th>
                    <th>Due Amount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tenants as $tenant)
                <tr>
                    <td>{{ $tenant->name }}</td>
                    <td>{{ $tenant->contact_number }}</td>
                    <td>{{ $tenant->status }}</td>
                    <td>{{ $tenant->room_number ?? '-' }}</td>
                    <td>₱{{ number_format($tenant->due_amount, 2) }}</td>
                    <td>
                        <a href="{{ route('tenant.show', $tenant->id) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('tenant.edit', $tenant->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('tenant.destroy', $tenant->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this tenant?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
