<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentalController extends Controller
{
    public function store(Request $request, $carId)
    {
        $car = Car::findOrFail($carId);

        // Validate rental dates
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Check car availability
        $existingRental = Rental::where('car_id', $carId)
                                ->where(function ($query) use ($request) {
                                    $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                                          ->orWhereBetween('end_date', [$request->start_date, $request->end_date]);
                                })
                                ->exists();

        if ($existingRental) {
            return redirect()->back()->withErrors('Car is not available for the selected dates.');
        }

        $rental = new Rental();
        $rental->user_id = Auth::id();
        $rental->car_id = $carId;
        $rental->start_date = $request->start_date;
        $rental->end_date = $request->end_date;
        $rental->total_cost = $car->daily_rent_price * (strtotime($request->end_date) - strtotime($request->start_date)) / 86400;
        $rental->save();

        return redirect()->route('frontend.rentals.index');
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

