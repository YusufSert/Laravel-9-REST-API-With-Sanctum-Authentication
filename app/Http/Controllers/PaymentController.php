<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'exp_mounth' => 'required',
            'exp_year' => 'required',
            'credit_cart_number' => 'required',
            'cvc' => 'required'
        ]);
        $data = Payment::create([
            'user_id' => auth()->user()->id,
            'exp_mounth' => $request->exp_mounth,
            'exp_year' => $request->exp_year,
            'credit_cart_number' => $request->credit_cart_number,
            'cvc' => $request->cvc
        ]);
         return response([
             'status' => '200',
         ]);
        //return $data['user_id'];
    }
}
