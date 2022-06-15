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

        $product = Product::findOrFail($id);
        
            Cart::create([
                "id" => $id,
                "name" => $product->name,
                'image_url' => $product->image_url,
                'price' => $product->price,
                'qty' => $request->qty,
            ]);

            $data = Cart::all();
        
            return response($data);
    }
}
