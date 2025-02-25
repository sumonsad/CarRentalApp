<nav class="bg-gray-800 p-4">
    <div class="flex justify-between items-center text-white">
        <a href="{{ route('admin.dashboard') }}" class="text-2xl">Car Rental Admin</a>
        <ul class="flex space-x-4">
            <li><a href="{{ route('admin.cars.index') }}">Manage Cars</a></li>
            <li><a href="{{ route('admin.rentals.index') }}">Manage Rentals</a></li>
            <li><a href="{{ route('admin.customers.index') }}">Manage Customers</a></li>
            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
        </ul>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>
</nav>
