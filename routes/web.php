<?php
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\CarController as AdminCarController;
use App\Http\Controllers\Admin\RentalController as AdminRentalController;
use App\Http\Controllers\Frontend\CarController as FrontendCarController;
use App\Http\Controllers\Frontend\PageController as FrontendPageController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Frontend\RentalController as FrontendRentalController;



Route::middleware([App\Http\Middleware\AdminMiddleware::class])->group(function () {
    Route::get('/dashboard', [AdminCarController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/cars', [AdminCarController::class, 'index'])->name('admin.cars.index');
    Route::get('/cars/create', [AdminCarController::class, 'create'])->name('admin.cars.create');
    Route::post('/cars', [AdminCarController::class, 'store'])->name('admin.cars.store');
    Route::get('/cars/{id}/edit', [AdminCarController::class, 'edit'])->name('admin.cars.edit');
    Route::put('/cars/{id}', [AdminCarController::class, 'update'])->name('admin.cars.update');
    Route::delete('/cars/{id}', [AdminCarController::class, 'destroy'])->name('admin.cars.destroy');

    // rental routes
    Route::get('/admin/rentals', [AdminRentalController::class, 'index'])->name('admin.rentals.index');
    Route::get('/rentals/create', [AdminRentalController::class, 'create'])->name('admin.rentals.create');

    // Route for editing a rental
    // Store rental (POST)
    Route::post('admin/rentals', [AdminRentalController::class, 'store'])->name('admin.rentals.store');

    // Show a rental (GET)
    Route::get('rentals/{rental}', [AdminRentalController::class, 'show'])->name('admin.rentals.show');

    // Edit rental form (GET)
    Route::get('rentals/{rental}/edit', [AdminRentalController::class, 'edit'])->name('admin.rentals.edit');

    // Update rental (PUT/PATCH)
    Route::put('rentals/{rental}', [AdminRentalController::class, 'update'])->name('admin.rentals.update');

    // Delete rental (DELETE)
    Route::delete('rentals/{rental}', [AdminRentalController::class, 'destroy'])->name('admin.rentals.destroy');

    Route::get('/admin/customers', [AdminCustomerController::class, 'index'])->name('admin.customers.index');
    Route::get('admin/customers/{user}', [AdminCustomerController::class, 'show'])->name('admin.customers.show');
    Route::get('admin/customers/{user}/edit', [AdminCustomerController::class, 'edit'])->name('admin.customers.edit');
    Route::put('admin/customers/{user}', [AdminCustomerController::class, 'update'])->name('admin.customers.update');
    Route::delete('admin/customers/{user}', [AdminCustomerController::class, 'destroy'])->name('admin.customers.destroy');
});

Route::middleware([App\Http\Middleware\CustomerMiddleware::class])->group(function () {
    Route::get('/customer/dashboard', [FrontendPageController::class, 'dashboard'])->name('customer.dashboard');
    Route::get('/customer/rentals', [FrontendRentalController::class, 'index'])->name('customer.rental');
    Route::post('rentals', [FrontendRentalController::class, 'store'])->name('frontend.rentals.store');
});


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [FrontendCarController::class, 'index'])->name('frontend.index');
Route::get('/cars/{car}', [FrontendCarController::class, 'show'])->name('cars.show');
Route::get('/about', [FrontendPageController::class, 'about'])->name('about');
Route::get('/contact', [FrontendPageController::class, 'contact'])->name('contact');
Route::get('/rentals', [FrontendCarController::class, 'rental'])->name('frontend.rentals');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');


require __DIR__.'/auth.php';
