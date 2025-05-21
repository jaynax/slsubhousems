{{-- resources/views/boardinghouse/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Boarding House</h2>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('boardinghouse.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Boarding House Name</label>
            <input type="text" class="form-control" name="name" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea class="form-control" name="address" required></textarea>
        </div>

        <div class="mb-3">
            <label for="contact_number" class="form-label">Contact Number</label>
            <input type="text" class="form-control" name="contact_number" required>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
