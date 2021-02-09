<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;
    // protected $table = 'bus';
    protected $fillable = [
        'bus_name',
        'img_url',
        'number_of_seat',
        'price',
        'status',
        'description'
    ];
    public function bookings(){
        return $this->belongsToMany(Booking::class,'booking_bus','booking_id','bus_id');
    }
}
