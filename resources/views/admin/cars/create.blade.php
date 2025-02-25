{{-- resources/views/admin/cars/create.blade.php --}}

@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Add New Car</h2>
        <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Car Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="brand">Brand</label>
                <input type="text" class="form-control" id="brand" name="brand" required>
            </div>
            <div class="form-group">
                <label for="model">Model</label>
                <input type="text" class="form-control" id="model" name="model" required>
            </div>
            <div class="form-group">
                <label for="year">Year</label>
                <input type="number" class="form-control" id="year" name="year" required>
            </div>
            <div class="form-group">
                <label for="car_type">Car Type</label>
                <input type="text" class="form-control" id="car_type" name="car_type" required>
            </div>
            <div class="form-group">
                <label for="daily_rent_price">Daily Rent Price</label>
                <input type="number" step="0.01" class="form-control" id="daily_rent_price" name="daily_rent_price" required>
            </div>
            <div class="form-group">
                <label for="availability">Availability</label>
                <select class="form-control" id="availability" name="availability" required>
                    <option value="1">Available</option>
                    <option value="0">Not Available</option>
                </select>
            </div>
            <div class="form-group">
                <label for="image">Car Image</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-success mt-3">Save Car</button>
        </form>
    </div>
@endsection
