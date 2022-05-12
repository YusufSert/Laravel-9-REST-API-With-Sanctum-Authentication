<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;



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

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

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

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
        
    }

    public function profile() {
        $id = auth()->user()->id;
        $user = User::find($id);

        return response($user);
    }
   
    public function update(Request $request) {
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

    
        return  response($data);
    }

    public function logout(Request $request) {
        $id = auth()->user()->id;
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out',
        ];
    }
}