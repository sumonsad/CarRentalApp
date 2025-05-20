@extends('layouts.app')
@include('frontend.navbar')
@section('content')
<div class="container">
    <h1 class="my-4 text-center">Available Cars for Rent</h1>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('frontend.rentals') }}" class="mb-4">
        <div class="row">
            <!-- Car Type Filter -->
            <div class="col-md-4">
                <label for="car_type">Car Type</label>
                <select name="car_type" id="car_type" class="form-control">
                    <option value="">All</option>
                    @foreach($carTypes as $type)
                        <option value="{{ $type }}" {{ request('car_type') == $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Brand Filter -->
            <div class="col-md-4">
                <label for="brand">Brand</label>
                <select name="brand" id="brand" class="form-control">
                    <option value="">All</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>{{ ucfirst($brand) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Max Daily Rent Price -->
            <div class="col-md-4">
                <label for="max_price">Daily Rent Price ($)</label>
                <input type="number" name="max_price" id="max_price" class="form-control" placeholder="Enter max price" value="{{ request('max_price') }}">
            </div>

            <div class="col-md-12 mt-3">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </div>
    </form>



    <!-- Car Cards -->
    <div class="row">
        @foreach ($cars as $car)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <img style="width:300px;height:200px;padding:0;" src="{{ Storage::url($car->image) }}" alt="{{ $car->name }}">
                    <h5 class="card-title"> {{ $car->name }}</h5>
                    <p class="card-text">Brand: {{ $car->brand }}</p>
                    <p class="card-text">Daily Rent: ${{ $car->daily_rent_price }}/day</p>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#carModal{{ $car->id }}">
                        Rent Now
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>


       <!-- Modal -->
       <div class="modal fade" id="carModal{{ $car->id }}" tabindex="-1" aria-labelledby="carModalLabel{{ $car->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="carModalLabel{{ $car->id }}">{{ $car->name }} - Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex">
                    <div style="flex: 2;margin-right:30px;">
                        <img src="{{ Storage::url($car->image) }}" alt="{{ $car->name }}" style="width:100%; height:100%; object-fit:cover;">
                    </div>
                    <div style="flex: 2;">
                        <p><strong>Name:</strong> {{ $car->name }}</p>
                        <p><strong>Brand:</strong> {{ $car->brand }}</p>
                        <p><strong>Model:</strong> {{ $car->model }}</p>
                        <p><strong>Year:</strong> {{ $car->year }}</p>
                        <p><strong>Daily Rent:</strong> ${{ $car->daily_rent_price }}/day</p>
                        <p><strong>Description:</strong> {{ $car->description }}</p>
                    </div>
                </div>

                <div class="modal-footer">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-warning">Login to Book</a>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    @else
                        <form action="{{ route('frontend.rentals.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="car_id" value="{{ $car->id }}">
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                            <div class="form-group mb-2">
                                <label for="start_date">Start Date</label>
                                <input type="date" name="start_date" class="form-control" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="end_date">End Date</label>
                                <input type="date" name="end_date" class="form-control" required>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Proceed to Booking</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
