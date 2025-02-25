@extends('layouts.app')



@section('content')
@include('frontend.navbar')
<div class="container">
    <section class="top-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h1>Rent the Best Cars with <span style="color:yellow;">Affordable <br> Prices<span></h1>
                    <p>Explore a wide range of cars for yours trips from luxury to economy we have the perfect vehicles for every occasion</p>
                    <a class="btn btn-primary" href="#" class="link" title="this is a action button">Browse Car</a>
            </div>
            <div class="col-md-4">
                <img src="" alt="image">
            </div>
        </div>
    </section>
    <h1 class="my-4 text-center">Featured Cars</h1>

    <!-- Filter Form (Optional)

    <!-- Car Cards -->
    <div class="row">
        @foreach ($cars as $car)
        <div class="col-md-4 mb-4">
            <div class="card">
               <!-- Car Image -->
               <div class="card-body">
                    <img style="width:300px;height:200px;padding:0;" src="{{ Storage::url($car->image) }}" alt="{{ $car->name }}">
                        <h5 class="card-title"> {{ $car->name }}</h5>
                        <p class="card-text"> Brand : {{ $car->brand }}</p>
                        <p class="card-text">Daily Rent: ${{ $car->daily_rent_price }}/day</p>
                        <a href="{{ route('cars.show', $car->id) }}" class="btn btn-primary">Rent Now</a>

                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

