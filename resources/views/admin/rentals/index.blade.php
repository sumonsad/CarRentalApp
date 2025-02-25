@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Rentals List</h1>

        <a href="{{ route('admin.rentals.create') }}" class="btn btn-primary">Create Rental</a>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Customer Name</th>
                    <th>Car Details (Name,Brand)</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Total Cost</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rentals as $rental)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $rental->user->name }}</td>
                        <td>{{ $rental->car->name }} ({{ $rental->car->brand }})</td>
                        <td>{{ $rental->start_date }}</td>
                        <td>{{ $rental->end_date }}</td>
                        <td>${{ $rental->total_cost }}</td>
                        <td>{{ $rental->status }}</td>
                        <td>
                            <a href="{{ route('admin.rentals.edit', $rental->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.rentals.destroy', $rental->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $rentals->links('pagination::bootstrap-5') }} <!-- Bootstrap 5 style pagination -->
        </div>
    </div>
@endsection
