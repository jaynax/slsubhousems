@extends('layouts.boardinghouse.index')

@section('content')
<div class="container mt-4">
    <div class="row">
        <!-- Boarding House Details -->
        <div class="col-lg-6 col-md-12">
            <div class="card shadow-sm p-4 mb-4">
                <h1 class="text-primary">{{ $boardinghouse->name }} - Dashboard</h1>
                <p><strong>📍 Address:</strong> {{ $boardinghouse->address }}</p>
                <p><strong>📞 Contact:</strong> {{ $boardinghouse->contact_number }}</p>
                <p><strong>🏠 Monthly Rent:</strong> <span class="text-success">{{ number_format($boardinghouse->monthly_rent, 2) }} PHP</span></p>
                <p><strong>📅 Yearly Rent:</strong> <span class="text-warning">{{ number_format($boardinghouse->yearly_rent, 2) }} PHP</span></p>
                <p><strong>⏳ Daily Rent:</strong> <span class="text-danger">{{ number_format($boardinghouse->daily_rent, 2) }} PHP</span></p>
            </div>
        </div>

        <!-- Tenants Table -->
        <div class="col-lg-6 col-md-12">
            <div class="card shadow-sm p-4">
                <h2 class="text-dark">👥 Tenants</h2>
                <div class="table-responsive">
                    <table class="table table-hover text-center">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>Tenant Name</th>
                                <th>Room No.</th>
                                <th>Status</th>
                                <th>Due (PHP)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tenants as $tenant)
                                <tr>
                                    <td class="fw-bold">{{ $tenant->user->name }}</td>
                                    <td>{{ $tenant->room_number }}</td>
                                    <td class="{{ $tenant->rent_status == 'Paid' ? 'text-success' : 'text-danger' }}">
                                        {{ $tenant->rent_status }}
                                    </td>
                                    <td>{{ number_format($tenant->payment_due, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Tenant Form -->
    <div class="row mt-4">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-sm p-4">
                <h2 class="text-dark text-center">➕ Add Tenant</h2>
                <form action="{{ route('boardinghouse.addTenant') }}" method="POST">
                    @csrf
                    <input type="hidden" name="boarding_house_id" value="{{ $boardinghouse->id }}">

                    <div class="mb-3">
                        <label class="form-label">👤 Tenant ID:</label>
                        <input type="number" name="user_id" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">🏠 Room Number:</label>
                        <input type="text" name="room_number" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">💰 Payment Type:</label>
                        <select name="payment_type" class="form-select">
                            <option value="monthly">Monthly - {{ number_format($boardinghouse->monthly_rent, 2) }} PHP</option>
                            <option value="yearly">Yearly - {{ number_format($boardinghouse->yearly_rent, 2) }} PHP</option>
                            <option value="daily">Daily - {{ number_format($boardinghouse->daily_rent, 2) }} PHP</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-user-plus"></i> Add Tenant
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Bootstrap Icons & FontAwesome for better UI -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection
