<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
         protected $fillable = [
        'category_name_en',
        'category_name_tr',
        'category_icon',
        'sub_category_slug_en',
        'sub_category_slug_tr',
    ];
}
