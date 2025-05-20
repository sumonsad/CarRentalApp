<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RentalController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'car_id' => 'required|exists:cars,id',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    $car = Car::findOrFail($request->car_id);

    $start = Carbon::parse($request->start_date);
    $end = Carbon::parse($request->end_date);
    $days = $start->diffInDays($end) + 1; // same day counts as 1 day

    $totalCost = $car->daily_rent_price * $days;

    Rental::create([
        'user_id' => $request->user_id,
        'car_id' => $request->car_id,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'total_cost' => $totalCost,
    ]);

    return redirect()->route('customer.dashboard')->with('success', 'Car booked successfully!');
}


    public function index()
    {
        $rentals = Rental::where('user_id', Auth::id())->get();
        return view('frontend.rentals.index', compact('rentals'));
    }

    public function destroy($id)
    {
        $rental = Rental::findOrFail($id);

        if ($rental->start_date > now()) {
            $rental->delete();
            return redirect()->route('frontend.rentals.index');
        }

        return redirect()->route('frontend.rentals.index')->with('error', 'You cannot cancel a rental that has already started.');
    }
}

