<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{
    function store(Request $request, $id)
    {
        // $request->validate([
        //     "name" => 'required',
        //     'image_url' => 'required',
        //     'price' => 'required',
        //     'qty' => 'required'
        // ]);
        $request->validate([
            'qty' => 'required',
        ]);
        $product = Product::find($id);
        if($product == null){return response(['status' => '404']);}
        
        $user_id = auth()->user()->id;
        $data = Cart::create([
                "id" => $product->id,
                "user_id" => $user_id,
                "name" => $product->name,
                'image_url' => $product->image_url,
                'price' => $product->price,
                'qty' => $request->qty,
            ]);

            //$data = Cart::all();
            
            return response([
                'status' => '200'
            ]);
    }

    function show()
    {
        $data = Cart::where('user_id', '=', auth()->user()->id)->get();
        if(Count($data) < 1)
        {
            return response([
                'status' => '404'
            ]);
        }
        return response([
            'status' => '200',
            'data' => $data,
        ]);
    }

    function remove($id)
    {
        $data = Cart::where([
            'user_id' => auth()->user()->id,
            'id' => $id,
        ]);
        // if($data ==){return response([
        //      'status' => '404',
        //  ]);}
    
        $data->delete();
        return response([
            'status' => '200',
        ]);
    }

}
