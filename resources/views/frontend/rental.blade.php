@extends('layouts.app')

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
                    <a href="{{ route('cars.show', $car->id) }}" class="btn btn-primary">Rent Now</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
