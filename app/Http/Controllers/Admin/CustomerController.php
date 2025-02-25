<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('role', 'customer')->get();
        return view('admin.customers.index', compact('customers'));
    }

    public function show(User $user)
    {
        $rentals = $user->rentals()->get();
        return view('admin.customers.show', compact('user','rentals'));
    }


    public function edit(User $user)
    {
        return view('admin.customers.edit', compact('user'));
    }

    // Update method to handle the update request
    public function update(Request $request, User $user)
    {
        // Validate the data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        // Update the customer data
        $user->update($request->only('name', 'email'));

        // Redirect back with a success message
        return redirect()->route('admin.customers.index')->with('success', 'Customer updated successfully');
    }


    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.customers.index');
    }
}
