<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Rental;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;


class RentalController extends Controller
{
    // Ensure only admins can access the rental management functions
    public function __construct()
    {
        //$this->middleware('Admin');
    }

    /**
     * Display a listing of all rentals.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get all rentals
        $rentals = Rental::with('car', 'user')->orderBy('created_at', 'desc')->paginate(5);
        return view('admin.rentals.index', compact('rentals'));
    }

    /**
     * Show the form for creating a new rental.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Get available cars and customers to create a new rental
        $cars = Car::where('availability', true)->get();
        $customers = User::where('role', 'customer')->get();
        return view('admin.rentals.create', compact('cars', 'customers'));
    }

    /**
     * Store a newly created rental in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'car_id' => 'required|exists:cars,id',
        'start_date' => 'required|date|after_or_equal:' . Carbon::today()->toDateString(),
        'end_date' => 'required|date|after_or_equal:start_date',
        'status' => 'required|in:Ongoing,Completed,Cancelled',
    ]);

    // Retrieve the selected car's daily rental price
    $car = Car::find($request->car_id);

    // Calculate the total days of the rental period
    $startDate = Carbon::parse($request->start_date);
    $endDate = Carbon::parse($request->end_date);
    $rentalDays = $startDate->diffInDays($endDate);

    // Calculate the total cost based on the daily rent price
    $totalCost = $car->daily_rent_price * $rentalDays;

    // Create the rental
    $rental = Rental::create([
        'user_id' => $request->user_id,
        'car_id' => $request->car_id,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'total_cost' => $totalCost,  // Set calculated total cost
        'status' => 'ongoing',  // Default to ongoing
    ]);

    // Update the car's availability
    $car->availability = false;
    $car->save();

    return redirect()->route('admin.rentals.index')->with('success', 'Rental created successfully.');
}


    /**
     * Display the specified rental.
     *
     * @param  \App\Models\Rental  $rental
     * @return \Illuminate\View\View
     */
    public function show(Rental $rental)
    {
        // Display details of a specific rental
        return view('admin.rentals.show', compact('rental'));
    }

    /**
     * Show the form for editing the specified rental.
     *
     * @param  \App\Models\Rental  $rental
     * @return \Illuminate\View\View
     */
    public function edit(Rental $rental)
    {
        // Get available cars and customers for editing the rental
        $cars = Car::where('availability', true)->get();
        $customers = User::where('role', 'customer')->get();
        return view('admin.rentals.edit', compact('rental', 'cars', 'customers'));
    }

    /**
     * Update the specified rental in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rental  $rental
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Rental $rental)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date|after_or_equal:' . Carbon::today()->toDateString(),
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:pending,ongoing,completed,canceled',
        ]);

        // Update rental details
        $rental->update([
            'user_id' => $request->user_id,
            'car_id' => $request->car_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
        ]);

        // If the rental is completed or canceled, update car availability
        if ($rental->status === 'completed' || $rental->status === 'canceled') {
            $car = Car::find($rental->car_id);
            $car->availability = true;
            $car->save();
        }

        return redirect()->route('admin.rentals.index')->with('success', 'Rental updated successfully.');
    }

    /**
     * Remove the specified rental from the database.
     *
     * @param  \App\Models\Rental  $rental
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Rental $rental)
    {
        // Before deleting the rental, ensure car availability is reset
        $car = Car::find($rental->car_id);
        $car->availability = true;
        $car->save();

        // Delete the rental
        $rental->delete();

        return redirect()->route('admin.rentals.index')->with('success', 'Rental deleted successfully.');
    }
}
