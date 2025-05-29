@extends('layouts.boardinghouse.index') <!-- Close this properly! -->

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-md mt-8">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Tenant Details</h1>

    <table class="w-full border-collapse border border-gray-300 text-left">
        <tbody>
            <tr class="border-b border-gray-200">
                <th class="px-4 py-2 bg-gray-100 font-semibold text-gray-700 w-1/3">Name</th>
                <td class="px-4 py-2 text-gray-900">{{ $tenant->name }}</td>
            </tr>
            <tr class="border-b border-gray-200">
                <th class="px-4 py-2 bg-gray-100 font-semibold text-gray-700">Email</th>
                <td class="px-4 py-2 text-gray-900">{{ $tenant->email }}</td>
            </tr>
            <tr class="border-b border-gray-200">
                <th class="px-4 py-2 bg-gray-100 font-semibold text-gray-700">Room Number</th>
                <td class="px-4 py-2 text-gray-900">{{ $tenant->room_number ?? 'N/A' }}</td>
            </tr>
            <tr class="border-b border-gray-200">
                <th class="px-4 py-2 bg-gray-100 font-semibold text-gray-700">Status</th>
                <td class="px-4 py-2 text-gray-900 capitalize">{{ $tenant->status ?? 'N/A' }}</td>
            </tr>
            <tr class="border-b border-gray-200">
                <th class="px-4 py-2 bg-gray-100 font-semibold text-gray-700">Due Amount</th>
                <td class="px-4 py-2 text-gray-900">₱{{ number_format($tenant->due_amount ?? 0, 2) }}</td>
            </tr>
            <tr>
                <th class="px-4 py-2 bg-gray-100 font-semibold text-gray-700 align-top">Notes</th>
                <td class="px-4 py-2 text-gray-900 whitespace-pre-line">{{ $tenant->notes ?? 'No additional notes.' }}</td>
            </tr>
        </tbody>
    </table>

    <div class="mt-8">
        <a href="{{ route('boardinghouse.tenants.index') }}" 
           class="inline-block bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition">
            ← Back to Tenants List
        </a>
    </div>
</div>
@endsection
