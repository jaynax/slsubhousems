@extends('layouts.admin.index')

@section('content')
<div class="container mt-4">
    <div class="card p-4">
        <h4>Manage Users</h4>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Add New User Button --}}
        <a href="{{ route('manage.users.create') }}" class="btn btn-primary mb-3">Add New User</a>

        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th class="text-center" style="width: 280px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role->name ?? 'N/A' }}</td>
                        <td class="text-center">
                            {{-- READ/VIEW button --}}
                            <a href="{{ route('manage.users.show', $user->id) }}" class="btn btn-info btn-sm me-1">View</a>

                            {{-- EDIT button --}}
                            <a href="{{ route('manage.users.edit', $user->id) }}" class="btn btn-warning btn-sm me-1">Edit</a>

                            {{-- DELETE button --}}
                            <form action="{{ route('manage.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm me-1">Delete</button>
                            </form>

                            {{-- Add Boarding House button ONLY if role_id == 3 --}}
                            @if($user->role && $user->role->id == 3)
                                <a href="{{ route('manage.users.boardinghouse.create', ['user' => $user->id]) }}" class="btn btn-success btn-sm mt-1">
                                    Add Boarding House
                                </a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
