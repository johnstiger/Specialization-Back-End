<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\Booking;

use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function history($id){
        $client = Client::find($id);
        $booking = Booking::all()->where('id',$client->id);
        return response() ->json($booking,201);
    }
}
