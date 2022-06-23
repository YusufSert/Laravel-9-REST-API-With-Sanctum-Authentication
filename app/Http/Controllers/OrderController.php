<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;

class OrderController extends Controller
{
    
    public function store(Request $request)

    {
        $id = auth()->user()->id;
        $cart = serialize(Cart::where('user_id', '=', $id)->get());
        $order = Order::create([
            'user_id' => $id,
            'payment_id' => '1234',
            'cart' => $cart,
        ]);
          return response([
        'status' => '200',
        'data' => $order,

        ]);

    }

    
    public function show()
    {
     
        $id = auth()->user()->id;
        $orders = Order::where('user_id', '=', $id)->get();
        $data = [];
        // for($i = 0; $i > count($order); $i++)
        // {
               
        //         $GLOBALS['data'][$i] = array([
        //         'id' => $order[$i]['cart'],
        //         'user_id' => $order[$i]['user_id'],
        //         'cart' => unserialize($order[$i]['cart']),
        //     ]);
           
        // }
        $a = [];
        $b = [];
        $data = [];
        $i = 0;
       foreach($orders as $order)
       {
        
         $a = unserialize($order['cart']);
         $temp = [
             'user_id' => $order['user_id'],
             'id' => $order['id'],
             'cart' => $a,
             'payment_id' => $order['payment_id'],
         ];
         //$data += array_merge($temp, $data);
         $data[$i] =  $temp;
         $i++;
       }
        return response($data);
     }   

}