<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $cars = Car::query();
        //$cars = Car::query()->get();  // get() will return collection of models (objects)

        if ($request->has('car_type')) {
            $cars->where('car_type', $request->car_type);
        }

        if ($request->has('brand')) {
            $cars->where('brand', $request->brand);
        }
        $cars = $cars->where('availability', true)->get();
        return view('frontend.home', compact('cars'));
    }

    public function rental(Request $request)
    {
        $cars = Car::query();
    
        if ($request->filled('car_type')) {
            $cars->where('car_type', $request->input('car_type'));
        }
    
        // Filter by Brand
        if ($request->filled('brand')) {
            $cars->where('brand', $request->input('brand'));
        }
    
        // Filter by Max Daily Rent Price
        if ($request->filled('max_price')) {
            $cars->where('daily_rent_price', '<=', $request->input('max_price'));
        }
    
        $cars = $cars->where('availability', true)->get();
    
        // Fetch unique car types and brands for the filter dropdown
        $carTypes = Car::select('car_type')->distinct()->pluck('car_type');
        $brands = Car::select('brand')->distinct()->pluck('brand');
    
        return view('frontend.rental', compact('cars', 'carTypes', 'brands'));
    }
    

    
    

    public function show($id)
    {
        $car = Car::findOrFail($id);
        return view('frontend.show', compact('car'));
    }
}

