@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Apply for a Room</h1>

    {{-- Success/Error Messages --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('tenant.apply') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="boarding_house_id" class="form-label">Select Boarding House</label>
            <select name="boarding_house_id" id="boarding_house_id" class="form-select" required>
                <option value="">-- Select Boarding House --</option>
                {{-- Assuming you pass $boardingHouses from your controller --}}
                @foreach($boardingHouses as $house)
                    <option value="{{ $house->id }}">{{ $house->name }}</option>
                @endforeach
            </select>
            @error('boarding_house_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="contact_number" class="form-label">Contact Number</label>
            <input type="text" name="contact_number" id="contact_number" class="form-control" value="{{ old('contact_number') }}" required>
            @error('contact_number')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Additional Notes (Optional)</label>
            <textarea name="notes" id="notes" rows="3" class="form-control">{{ old('notes') }}</textarea>
            @error('notes')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit Application</button>
    </form>
</div>
@endsection
