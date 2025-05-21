@extends('layouts.users.index')

@section('content')
<div class="container mx-auto max-w-md p-6 bg-white rounded shadow-md">
    <h2 class="text-2xl font-semibold mb-4">Tenant Application</h2>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-200 text-red-800 p-3 mb-4 rounded">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('tenant.apply') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="name" class="block font-medium mb-1">Name</label>
            <input type="text" id="name" name="name" 
                value="{{ Auth::user()->name }}" readonly
                class="w-full border rounded px-3 py-2 bg-gray-100 cursor-not-allowed" />
        </div>

        <div class="mb-4">
            <label for="contact_number" class="block font-medium mb-1">Contact Number</label>
            <input type="text" id="contact_number" name="contact_number" 
                value="{{ old('contact_number', Auth::user()->phone) }}" required
                class="w-full border rounded px-3 py-2 @error('contact_number') border-red-500 @enderror" />
            @error('contact_number')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="notes" class="block font-medium mb-1">Notes (optional)</label>
            <textarea id="notes" name="notes" rows="4" maxlength="1000"
                class="w-full border rounded px-3 py-2 @error('notes') border-red-500 @enderror">{{ old('notes') }}</textarea>
            @error('notes')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Submit Application
        </button>
    </form>
</div>
@endsection
