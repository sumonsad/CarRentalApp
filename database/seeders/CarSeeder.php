<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Storage;

class CarSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            $car = new Car();
            $car->name = $faker->company;
            $car->brand = $faker->companySuffix;
            $car->model = $faker->word;
            $car->year = $faker->year;
            $car->car_type = $faker->randomElement(['Sedan', 'SUV', 'Truck', 'Van']);
            $car->daily_rent_price = $faker->numberBetween(100, 300);
            $car->availability = $faker->boolean;

            // Generate a random image name and save it to public storage
            $imageName = 'car_' . uniqid() . '.jpg';
            $imageContent = file_get_contents('https://picsum.photos/200'); // Get random image from Lorem Picsum
            Storage::disk('public')->put('cars/' . $imageName, $imageContent); // Save it in storage/app/public/cars

            $car->image = 'cars/' . $imageName; // Store the relative path

            // Save the car record
            $car->save();
        }
    }
}

