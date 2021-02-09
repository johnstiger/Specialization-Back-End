<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Driver;
class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $driver = Driver::count();
        if($driver == 0){
            return response()->json(["message" => "This field is empty"], 404);
        }
        return response()->json(Driver::get(), 200);
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
            'firstname' => 'required|min:3',
            'lastname' => 'required|min:3',
            'contact_number' => 'required|max:11|unique:client',
            'address' => 'required|min:3',
            'license' => 'required'
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        $driver = Driver::create($request->all());
        return response()->json($driver, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $driver = Driver::find($id);
        if(is_null($driver)){
            return response()->json(["message" => "Id is not Found!"], 404);
        }
        return response()->json($driver, 200);
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
        $driver = Driver::find($id);
        if(is_null($driver)){
            return response()->json(["message" => "Id is not Found!"], 404);
        }
        $driver->update($request->all());
        return response()->json($driver, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $driver = Driver::find($id);
        if(is_null($driver)){
            return response()->json(["message" => "Id is not Found!"], 404);
        }
        $driver->delete();
        return response()->json(["message" => "Successfully deleted!"], 204);
    }
}
