<?php

  

namespace App\Http\Controllers;
use App\Models\Bus;  

use Illuminate\Http\Request;

  

class ImageUploadController extends Controller

{

     /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function imageUpload()

    {

        return view('imageUpload');

    }

    

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function imageUploadPost(Request $request)

    {

        $request->validate([

            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

    

        $imageName = time().'.'.$request->image->extension();  

     

        $request->image->move(public_path('images'), $imageName);

        dd($imageName);
        /* Store $imageName name in DATABASE from HERE */
        $img = new Bus();
        $img->bus_name = 'test';
        $img->img_url = $imageName;
        $img->description = 'test';
        $img->number_of_seat = 'price';
        $img->status = '1';

        return back()

            ->with('success','You have successfully upload image.')

            ->with('image',$imageName); 

    }

}