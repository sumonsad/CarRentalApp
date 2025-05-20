@extends('layouts.admin')

@section('content')
    <h2>Admin Dashboard</h2>
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Cars</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalCars }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Available Cars</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $availableCars }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Total Rentals</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalRentals }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Total Earnings</div>
                <div class="card-body">
                    <h5 class="card-title">${{ $totalEarnings }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card border-info">
                <div class="card-header bg-info text-white">User Information</div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    <p><strong>Phone:</strong> {{ Auth::user()->phone ?? 'N/A' }}</p>
                    <p><strong>Joined At:</strong> {{ Auth::user()->created_at->format('F d, Y') }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
