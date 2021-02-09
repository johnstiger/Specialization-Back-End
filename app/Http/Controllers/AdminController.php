<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use TheSeer\Tokenizer\Exception;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = Admin::count();
        if ($admin == 0) {
            return response()->json(["message" => "This field is empty"], 404);
        }
        return response()->json(Admin::all(), 200);
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
            'name' => 'required|min:3',
            'email' => 'required|min:3|unique:admin',
            'password' => 'required|min:8'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $this->register($request);
        return response()->json(["message"=>"Added Successfully!"], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = Admin::find($id);
        if (is_null($admin)) {
            return response()->json(["message" => "Id is not Found!"], 404);
        }
        return response()->json($admin, 200);
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
        $admin = Admin::find($id);
        if (is_null($admin)) {
            return response()->json(["message" => "Id is not Found!"], 404);
        }
        $admin->update($request->all());
        return response()->json($admin, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::find($id);
        if (is_null($admin)) {
            return response()->json(["message" => "Id is not Found!"], 404);
        }
        $admin->delete();
        return response()->json(["message" => "Successfully deleted!"], 204);
    }


    //Log-Reg   

    public function login(Request $request)
    {
        try {
            // $request->validate([
            //   'email' => 'email|required',
            //  'password' => 'required'
            // ]);
            // $credentials = request(['email', 'password']);
            // if (!Auth::attempt($credentials)) {
            //     return response()->json([
            //     'status_code' => 500,
            //     'message' => 'UnAuthorized'
            //   444444444444
            $validation  = Validator::make($request->all(), [
                    'email'=> "required",
                    'password'=> 'required'
                ]);

            if($validation->fails()) {
                return response()->json($validation->errors());
            }
            $user = Admin::where('email', $request->email)->first();
            // return response()->json($user);
            if (!$user || !Hash::check($request->password, $user->password)) {
                throw new \Exception('Error Log In');
            }
            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return response()->json([
              'status_code' => 200,
              'access_token' => $tokenResult,
              'token_type' => 'Bearer',
            ]);
        } catch (Exception $error) {
            return response()->json([
              'status_code' => 500,
              'message' => 'Error Log In',
              'error' => $error,
            ]);
        }
    }
    public function logout()
    {
    }
    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|min:3|unique:users',
            'password' => 'required|min:8'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->save();
        return response()->json($admin, 201);
    }
}
