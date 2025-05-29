@extends('layouts.boardinghouse.index')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Tenant Applications</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($tenants->isEmpty())
        <p>No tenant applications found.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Status</th>
                    <th>Room #</th>
                    <th>Due</th>
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
                    <td>₱{{ number_format($tenant->due_amount, 2) ?? '0.00' }}</td>
                    <td>
                        <a href="{{ route('tenant.edit', $tenant->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('tenant.destroy', $tenant->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
