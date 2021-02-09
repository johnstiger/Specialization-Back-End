<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    // protected $table = 'booking';
    protected $fillable = [
        'start_date',
        'end_date',
        'price',
        'payment',
        'status'
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }
    public function buses(){
        return $this->belongsToMany(Bus::class,'booking_bus','booking_id','bus_id');
    }
    
}
