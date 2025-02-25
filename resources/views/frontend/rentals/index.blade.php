@extends('layouts.customer')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">My Rentals</h2>
        @if($rentals->count() > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Car</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rentals as $key => $rental)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $rental->car->name ?? 'N/A' }}</td>
                            <td>{{ $rental->start_date }}</td>
                            <td>{{ $rental->end_date }}</td>
                            <td>${{ $rental->price }}</td>
                            <td>
                                @if($rental->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($rental->status == 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @else
                                    <span class="badge bg-danger">Cancelled</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="alert alert-info">You have no rentals yet.</p>
        @endif
    </div>
@endsection
