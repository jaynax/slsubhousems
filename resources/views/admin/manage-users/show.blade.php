@extends('layouts.admin.index')

@section('content')
<div class="container mt-4">
    <div class="card p-4">
        <h4>User Details</h4>

        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Role</th>
                <td>{{ $user->role->name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Created At</th>
                <td>{{ $user->created_at->format('F d, Y h:i A') }}</td>
            </tr>
            <tr>
                <th>Updated At</th>
                <td>{{ $user->updated_at->format('F d, Y h:i A') }}</td>
            </tr>
        </table>

        <a href="{{ route('manage.users') }}" class="btn btn-secondary btn-sm">Back to List</a>
    </div>
</div>
@endsection
