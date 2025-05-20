@extends('layouts.app')

@section('content')
@include('frontend.navbar')
<div class="container">

    <!-- Hero Section -->
    <section class="top-section">
        <div class="container">
            <div class="row d-flex align-items-stretch">
                <div class="col-md-8 d-flex flex-column justify-content-center">
                    <h1>Rent the Best Cars with <span style="color:yellow;">Affordable <br> Prices</span></h1>
                    <p>Explore a wide range of cars for your trips — from luxury to economy, we have the perfect vehicles for every occasion.</p>
                    <a class="btn btn-primary" href="#" title="this is an action button">Browse Car</a>
                </div>
                <div class="col-md-4">
                    <img style="width:100%; height:100%; object-fit:cover;" src="{{ Storage::url('cars/toyota.jpg') }}" alt="">
                </div>
            </div>
        </div>
    </section>

    <h1 class="my-4 text-center">Featured Cars</h1>

    <!-- Cars List -->
    <div class="row">
        @foreach ($cars as $car)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img style="width:100%; height:200px; object-fit:cover;" src="{{ Storage::url($car->image) }}" alt="{{ $car->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $car->name }}</h5>
                    <p class="card-text">Brand: {{ $car->brand }}</p>
                    <p class="card-text">Daily Rent: ${{ $car->daily_rent_price }}/day</p>
                    <!-- Modal Trigger -->
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#carModal{{ $car->id }}">
                        Rent Now
                    </button>
                </div>
            </div>
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
        @endforeach
    </div>
</div>
@endsection
