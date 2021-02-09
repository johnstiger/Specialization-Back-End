<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Validator;
use DateTime;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailBooking;
use App\Models\Client;
use App\Models\Bus;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $booking = Booking::count();
        if($booking == 0){
            return response()->json(["message" => "This field is empty"], 404);
        }
        return response()->json(Booking::with('buses')->where('status',1)->get(), 200);
    }
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Client $client)
    {
        $day = date('Y-m-d');
        $rules = [
            'start_date' => "required |date_format:Y-m-d|after: $day|unique:bookings",
            'end_date' => 'required |date_format:Y-m-d|after_or_equal:start_date',
            'payment' => 'required',
            'status' => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $fdate = $request->start_date;
        $tdate = $request->end_date;
        $dateTime1 = new DateTime($fdate);
        $dateTime2 = new DateTime($tdate);
        $interval = $dateTime1->diff($dateTime2);
        $interval->format('%a');

        
        $booking = new Booking();
        $booking->client_name = $client->firstname." ".$client->lastname;
        $booking->bus_name = $request->bus_name;
        $booking->start_date = $request->start_date;
        $booking->end_date = $request->end_date;
        $booking->price = $interval->format('%a')*$request->price;
        $booking->payment = $request->payment;
        $booking->status = $request->status;
        $booking->save();

        $details = [
            'title'=> 'New Client Booked',
            'firstname' => $client->firstname,
            'lastname' => $client->lastname,
            'email_address' => $client->email_address,
            'bus_name' => $request->bus_name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'price' => $interval->format('%a')*$request->price,
            'payment' => $request->payment,
            'status' => $request->status,
        ];
        Mail::to("johnstiger12@gmail.com")->send(new EmailBooking($details));
        return response()->json(["message" => "Booking sent!"], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booking = Booking::find($id);
        if(is_null($booking)){
            return response()->json(["message" => "Id is not Found!"], 404);
        }
        return response()->json($booking, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $booking = Booking::find($id);
        if(is_null($booking)){
            return response()->json(["message" => "Id is not Found!"], 404);
        }
        $booking->update($request->all());
        return response()->json($booking, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $booking = Booking::find($id);
        if(is_null($booking)){
            return response()->json(["message" => "Id is not Found!"], 404);
        }
        $booking->delete();
        return response()->json(["message" => "Successfully deleted!"], 204);
    }
}
