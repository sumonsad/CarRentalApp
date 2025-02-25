@extends('layouts.admin')  {{-- Assuming you have an admin layout file. Change if necessary. --}}

@section('content')
    <div class="container">
        <h2>Create Rental</h2>

        <!-- Display any validation errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.rentals.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="user_id">Customer</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    <option value="">Select Customer</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }} ({{ $customer->email }})</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="car_id">Car</label>
                <select name="car_id" id="car_id" class="form-control" required>
                    <option value="">Select Car</option>
                    @foreach($cars as $car)
                        <option value="{{ $car->id }}" {{ $car->availability == false ? 'disabled' : '' }}>
                            {{ $car->name }} - {{ $car->brand }} ({{ $car->car_type }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" name="start_date" id="start_date" class="form-control" required min="{{ \Carbon\Carbon::today()->toDateString() }}">
            </div>

            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" name="end_date" id="end_date" class="form-control" required min="{{ \Carbon\Carbon::today()->toDateString() }}">
            </div>

            <div class="form-group">
                <label for="status">Rental Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="">Select Status</option>
                    <option value="Pending">Pending</option>
                    <option value="Ongoing">Ongoing</option>
                    <option value="Completed">Completed</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create Rental</button>
            <a href="{{ route('admin.rentals.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
