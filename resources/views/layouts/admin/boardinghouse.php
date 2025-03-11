@extends('layouts.admin.index')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Boarding Houses</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Boarding House</th>
                    <th>Location</th>
                    <th>Rent (₱)</th>
                    <th>Tenants</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($boardingHouses as $house)
                    <tr>
                        <td>{{ $house->name }}</td>
                        <td>{{ $house->location }}</td>
                        <td>{{ number_format($house->rent, 2) }}</td>
                        <td>{{ $house->tenants->count() }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tenantsModal{{ $house->id }}">View Tenants</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@foreach($boardingHouses as $house)
    <!-- Modal for Tenants -->
    <div class="modal fade" id="tenantsModal{{ $house->id }}" tabindex="-1" role="dialog" aria-labelledby="tenantsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tenants of {{ $house->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Room</th>
                                <th>Payment Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($house->tenants as $tenant)
                                <tr>
                                    <td>{{ $tenant->user->name }}</td>
                                    <td>{{ $tenant->user->contact }}</td>
                                    <td>{{ $tenant->room_number }}</td>
                                    <td>
                                        @if($tenant->payment)
                                            <span class="badge {{ $tenant->payment->status == 'paid' ? 'badge-success' : 'badge-danger' }}">
                                                {{ ucfirst($tenant->payment->status) }}
                                            </span>
                                        @else
                                            <span class="badge badge-danger">Unpaid</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.payment.update', $tenant->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="{{ $tenant->payment && $tenant->payment->status == 'paid' ? 'unpaid' : 'paid' }}">
                                            <button type="submit" class="btn btn-sm {{ $tenant->payment && $tenant->payment->status == 'paid' ? 'btn-warning' : 'btn-success' }}">
                                                {{ $tenant->payment && $tenant->payment->status == 'paid' ? 'Mark as Unpaid' : 'Mark as Paid' }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection