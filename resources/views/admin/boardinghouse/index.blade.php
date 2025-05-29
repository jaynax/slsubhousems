@extends('layouts.admin.index') {{-- assuming you have a main admin layout --}}

@section('title', 'Boarding Houses')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Boarding Houses List</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($boardingHouses->isEmpty())
        <p>No boarding houses found.</p>
    @else
        <table class="min-w-full bg-white border border-gray-300 rounded shadow">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="py-2 px-4 border-b">Owner</th>
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Location</th>
                    <th class="py-2 px-4 border-b">Contact Number</th>
                    <th class="py-2 px-4 border-b">Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach($boardingHouses as $house)
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 px-4 border-b">{{ $house->user->name ?? 'N/A' }}</td>
                        <td class="py-2 px-4 border-b">{{ $house->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $house->location }}</td>
                        <td class="py-2 px-4 border-b">{{ $house->contact_number }}</td>
                        <td class="py-2 px-4 border-b">{{ $house->description ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
