@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Customer Details</h2>

    <div class="card">
        <div class="card-body">
            <h4>Name: {{ $user->name }}</h4>
            <p>Email: {{ $user->email }}</p>
            <p>Joined At: {{ $user->created_at->format('d M Y') }}</p>

            <a href="{{ route('admin.customers.edit', $user->id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>

    <h3>Rental History</h3>
    @if($rentals->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Car</th>
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
                        <td>{{ $rental->car->name }} ({{ $rental->car->brand }})</td>
                        <td>{{ $rental->start_date }}</td>
                        <td>{{ $rental->end_date }}</td>
                        <td>${{ $rental->total_cost }}</td>
                        <td>{{ ucfirst($rental->status) }}</td>
                        <td>
                            <!-- Edit button -->
                            <a href="{{ route('admin.rentals.edit', $rental->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <!-- Delete button -->
                            <form action="{{ route('admin.rentals.destroy', $rental->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No rental history found for this customer.</p>
    @endif
</div>
@endsection
