@extends('layouts.admin.index')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <!-- Welcome Card -->
        <div class="col-xxl-8 mb-6 order-0">
            <div class="card">
                <div class="d-flex align-items-start row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary mb-3">WELCOME ADMIN {{ Auth::user()->name }} 🎉</h5>
                            <p class="mb-6">SLSU BOARDING HOUSE MANAGEMENT SYSTEM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Boarding House Details -->
        
        </div>
    </div>
</div>
@endsection
