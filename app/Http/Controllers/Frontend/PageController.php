<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;
class PageController extends Controller
{
    public function dashboard()
    {
        $totalCars = Car::count();
        $availableCars = Car::where('availability', true)->count();
        $totalRentals = \App\Models\Rental::count();
        return view('customer.dashboard', compact('totalCars', 'availableCars', 'totalRentals'));
    }
    public function home()
    {
        return view('frontend.home');
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }


}
