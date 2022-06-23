<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

     protected $fillable = [
        'credit_cart_number',
        'exp_mounth',
        'exp_year',
        'cvc',
        'user_id'
    ];


     protected $hidden = [
        //'credit_cart_number',
    ];
}
