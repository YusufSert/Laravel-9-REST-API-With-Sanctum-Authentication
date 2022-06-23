<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;

class OrderController extends Controller
{
    
    public function store(Request $request)

    {
      $request->validate([
        'total_price' => 'required'
      ]);
        $id = auth()->user()->id;
        $cart = serialize(Cart::where('user_id', '=', $id)->get());
        $payment = Payment::where('user_id', '=', $id)->get();
        $pId = $payment[0]['id'];
        $order = Order::create([
            'user_id' => $id,
            'payment_id' => $pId,
            'cart' => $cart,
            'total_price' => $request->total_price
        ]);
          return response([
        'status' => '200',
        //'data' => $order,

        ]);

    }

    
    public function show()
    {
     
        $id = auth()->user()->id;
        $orders = Order::where('user_id', '=', $id)->get();
        if(count($orders) < 1){return response(['status' => '404']);}
        //$data = [];
        // for($i = 0; $i > count($order); $i++)
        // {
               
        //         $GLOBALS['data'][$i] = array([
        //         'id' => $order[$i]['cart'],
        //         'user_id' => $order[$i]['user_id'],
        //         'cart' => unserialize($order[$i]['cart']),
        //     ]);
           
        // }
        $a = [];
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
        return response([
          'status' => '200',
          'data' => $data,
        ]);
     }   

}