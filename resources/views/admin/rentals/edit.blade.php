@extends('layouts.admin') <!-- Assuming you have a layout file for the admin panel -->

@section('content')
    <div class="container">
        <h2>Edit Rental</h2>

        <!-- Display validation errors if any -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.rentals.update', $rental->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- PUT method for updating -->

            <div class="form-group">
                <label for="user_id">Customer:</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    <option value=""></option>
                    <option value="">Select a customer</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}" {{ $rental->user_id == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }} ({{ $customer->email }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="car_id">Car:</label>
                <select name="car_id" id="car_id" class="form-control" required>
                    <option value="{{ $rental->car->id }}" selected>
                        {{ $rental->car->name }}
                    </option>
                    @foreach ($cars as $car)
                        @if ($car->id != $rental->car->id)
                            <option value="{{ $car->id }}">
                                {{ $car->name }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $rental->start_date }}" required>
            </div>

            <div class="form-group">
                <label for="end_date">End Date:</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $rental->end_date }}" required>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="{{ $rental->status }}" selected>
                        {{ ucfirst($rental->status) }}
                    </option>
                    @foreach (['pending', 'ongoing', 'completed', 'cancelled'] as $status)
                        @if ($status != $rental->status)
                            <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                        @endif
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update Rental</button>
                <a href="{{ route('admin.rentals.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
