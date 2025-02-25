<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'car_id', 'start_date', 'end_date', 'total_cost', 'status'];

    // Relationship: A rental belongs to a car
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    // Relationship: A rental belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
