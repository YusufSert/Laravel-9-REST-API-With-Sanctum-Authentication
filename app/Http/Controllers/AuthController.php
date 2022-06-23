<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Models\Admin;
use App\Models\Address;
use Illuminate\Cookie\CookieValuePrefix;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function register(Request $request) {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
            'phone' => 'required|string',
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'phone' => $fields['phone'],
            'profile_photo_path' => "no_image.jpg",
        ]);

        $token = $user->createToken('JWT')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    // public  function viewLogin() {
    //     return view('Backend.login');
    // }
    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $user->createToken('JWT')->plainTextToken;
        //$cookie = cookie()->queue("loginToken", $token, 60*24*365*10, null, null, null, true, false, 'None');
        //$cookie = cookie('JWT', $token, 60);



        $cookie = cookie('JWT', $token, 60,null, null, null, true, false, 'None'); // 60min cookie

        $response = [
            'user' => $user,
            'token' => $token // keep token for now if cookie not work
        ];

        //return view('Backend.dashboard',compact('response'));
        
        //return view('login', $response);

        return response($response)->cookie($cookie);
        //return response($response);
    }

    public function edit(Request $request) {
        $id = auth()->user()->id;
        $user = User::find($id);
        $token = $request->bearerToken(); // get currernt token

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);

    }
   
    public function store(Request $request) {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string|confirmed',
            'phone' => 'required|string',
            //'profile_photo_path' => 'required',
        ]);

        $id = auth()->user()->id;
        $data = User::find($id);
        $data->name = $fields['name'];
        $data->email = $fields['email'];
        $data->phone = $fields['phone'];
        $data->password = Hash::make($fields['password']);

        if($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            $filename = date('Ymdhi').'.'.$file->getClientOriginalExtension();
            Image::make($file)->resize(400,400)->save(public_path('/upload/user/'.$filename));
            $data->profile_photo_path = $filename;
        }
        
        $data->save();

    
        $token = $request->bearerToken(); // get currernt token

        $response = [
            'user' => $data,
            'token' => $token
        ];

        //return $response;
    }

    public function logout() {
        $cookie = Cookie::forget('JWT');
        $id = auth()->user()->id;
        auth()->user()->tokens()->where('tokenable_id', $id)->delete(); // it will delete the specific logged in user 'tokenable_id = user->id'
        return response([
            'message' => 'Byzzzzz',
        ])->withCookie($cookie);
    }

    public function address(Request $request)
    {
        $request->validate([
            'adress' => 'required',
            'adress2' => 'required',
            'district' => 'required',
            'postal_code' => 'required',
        ]);

        $adress = Address::create([
            'adress' => $request->adress,
            'adress2' => $request->adress2,
            'district' => $request->district,
            'postal_code' => $request->postal_code,
        ]);
       

        User::findOrFail(auth()->user()->id)->update([
            'address_id' => $adress->id,
        ]);

         return response([
            'status' => '201 Created 🐸',
            'data' => $adress,

        ]);
    }

    public function viewAddress() {
        $adressId = auth()->user()->address_id;
        $data = Address::findOrFail($adressId);
        return response([
            'status' => '200 OK 🐺',
            'data' => $data,
            'id' => $adressId,
        ]);
    }
     public function passwordUpdate(Request $request){
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = auth()->user()->password;
        if(Hash::check($request->oldpassword, $hashedPassword))
        {
            $user = User::find(auth()->user()->id);
            $user->password = Hash::make($request->password);
            $user->save();
        }
    }
     
}