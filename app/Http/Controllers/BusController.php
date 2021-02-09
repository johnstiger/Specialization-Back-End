<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Bus;


class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bus = Bus::count();
        if($bus == 0){
            return response()->json(["message" => "This field is empty"], 404);
        }
        return response()->json(Bus::all(), 200);
    }

    public function viewClient(){
        $bus = Bus::count();
        if($bus == 0){
            return response()->json(["message" => "This field is empty"], 404);
        }
        return response()->json(Bus::all(), 200);
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
    public function store(Request $request)
    {
        $rules = [
            'img_url' => 'unique:buses',
            'bus_name' => 'required',
            'number_of_seat' => 'required',
            'status' =>'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        
        $bus = new Bus();
        $bus->bus_name = $request->bus_name;
        $bus->img_url = $request->img_url;
        $bus->number_of_seat =$request->number_of_seat;
        $bus->price = $request->price;
        $bus->status = $request->status;
        $bus->description = $request->description;
        $bus->save();

        return response()->json($bus, 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bus = Bus::find($id);
        if(is_null($bus)){
            return response()->json(["message" => "Id is not Found!"], 404);
        }
        return response()->json($bus, 200);
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
        $bus = Bus::find($id);
        if(is_null($bus)){
            return response()->json(["message" => "Id is not Found!"], 404);
        }
        $bus->update($request->all());
        return response()->json($bus, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bus = Bus::find($id);
        if(is_null($bus)){
            return response()->json(["message" => "Id is not Found!"], 404);
        }
        $bus->delete();
        return response()->json('deleted', 204);
    }
}
