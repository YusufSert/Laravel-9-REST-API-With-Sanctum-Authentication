<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Models\Admin;
use Laravel\Sail\Console\PublishCommand;

class AdminController extends Controller
{


    // public  function viewLogin() {
    //     return view('Backend.login');
    // }


    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = Admin::where('email', $fields['email'])->first();

        // Check password
         if(!$user || !Hash::check($fields['password'], $user->password)) {
             return response([
                 'message' => 'Bad creds',
             ], 401);
        }
        // if($user->password != Hash::make($request->password))
        // {
        //     return response([
        //         'message' => 'Bad creds'
        //     ], 401);
        // }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        //return view('Backend.dashboard2',compact('response'));
        
        //return view('login', $response);
        return response([
            'status' => '200'
        ]);
    }
    
    public function AdminProfile() {
        $data = Admin::find(1);
           $response = [
            'user' => $data,
        ];
        if($data == null)
        {
            return response("404");
        }
        //return view('Backend.profile', compact('response'));
        return response([
            'status' => '200',
            'data' => $data,
        ]);
    }   

    // public function AdminEdit(Request $request) {
        
    //     $user =  $data = Admin::find(1);
    //     $token = $request->bearerToken(); // get currernt token

    //     $response = [
    //         'user' => $user,
    //         'token' => $token
    //     ];

    //     return response($response, 201);

    // }
   
    public function AdminStore(Request $request) {
        $request->validate([
            'email' => 'required|string',
            'name' => 'required|string'
        ]);
        if($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            $filename = date('Ymdhi').'.'.$file->getClientOriginalExtension();
            Image::make($file)->resize(400,400)->save(public_path('/upload/admin_images/'.$filename));
            $profile_photo_path = url('/upload/admin_images').'/'.$filename;
        }
        Admin::find(3)->update([
            'email' => $request->email,
            'name' => $request->name,
            'profile_photo_path' => $profile_photo_path,
        ]);

        return response([
            'status' => '200'
        ]);
        
    }

    

    public function logout(Request $request) {
        $id = auth()->user()->id;
        auth()->user()->tokens()->where('tokenable_id', $id)->delete(); // it will delete the specific logged in user 'tokenable_id = user->id'
        return [
            'message' => 'Logged out',
        ];
    }   
}
