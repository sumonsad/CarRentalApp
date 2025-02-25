<nav class="bg-gray-800 p-4">
    <div class="flex justify-between items-center text-white">
        <a href="{{ route('customer.dashboard') }}" class="text-2xl">Car Rental</a>
        <ul class="flex space-x-4">
            <li><a href="{{ route('customer.rentals.index') }}">My Bookings</a></li>
            <li><a href="{{ route('customer.cars.index') }}">Browse Cars</a></li>
            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
        </ul>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>
</nav>
