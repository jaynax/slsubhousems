@extends('layouts.admin.index')

@section('content')
<div class="container mt-4">
    <div class="card p-4">
        <h4>Edit User</h4>

        <form action="{{ route('manage.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Update User</button>
        </form>
    </div>
</div>
@endsection
