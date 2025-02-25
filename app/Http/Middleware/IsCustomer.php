<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsCustomer
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role !== 'customer') {
            return redirect('/'); // or any page you prefer
        }

        return redirect()->route('login')->with('error', 'You need to be logged in as a customer.');
    }
}

