<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'brand', 'model', 'year', 'car_type', 'daily_rent_price', 'availability', 'image'];

    // Relationship: One car has many rentals
    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}
