{{-- resources/views/admin/cars/index.blade.php --}}

@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <a href="{{ route('admin.cars.create') }}" class="btn btn-primary">Add New Car</a>
            </div>
        </div>

        <div class="row">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Car Name</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>Rent Price</th>
                        <th>Availability</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cars as $car)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $car->name }}</td>
                        <td>{{ $car->brand }}</td>
                        <td>{{ $car->model }}</td>
                        <td>{{ $car->year }}</td>
                        <td>${{ $car->daily_rent_price }}</td>
                        <td>
                            <span class="badge bg-{{ $car->availability ? 'success' : 'danger' }}">
                                {{ $car->availability ? 'Available' : 'Not Available' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.cars.edit', $car->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.cars.destroy', $car->id) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
             <!-- Pagination Links -->
             <div class="d-flex justify-content-center">
                {{ $cars->links('pagination::bootstrap-5') }} <!-- Bootstrap 5 style pagination -->
            </div>
        </div>
    </div>
@endsection
