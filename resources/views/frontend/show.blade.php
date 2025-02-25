@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="col-md-6">
                        <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->name }}" style="max-width: 100%; height: auto;">
                    </div>
                </div>
                <div class="col-md-6">
                <h1>{{ $car->name }}</h1>
                <p><strong> Brand : </strong>{{ $car->brand }}</p>
                <p><strong>Model:</strong> {{ $car->model }}</p>
                <p><strong>Year:</strong> {{ $car->year }}</p>
                <p><strong>Type:</strong> {{ $car->type }}</p>
                <h1><strong>Daily Rent:</strong> BDT{{ $car->daily_rent_price }}</h1>
                <div class="date-container" style="display: flex; gap: 20px; align-items: center;">
                    <div>
                        <label for="start_date">Start Date</label>
                        <input type="date" id="start_date" name="start_date" class="form-control">
                    </div>

                    <div>
                        <label for="end_date">End Date</label>
                        <input type="date" id="end_date" name="end_date" class="form-control">
                    </div>
                </div>
                    <!-- Rent Now Button (optional) -->
                    <a href="{{ route('customer.rental', $car->id) }}" class="btn btn-success">Rent Now</a>
            </div>
        </div>
     </div>
</div>
</div>
@endsection
