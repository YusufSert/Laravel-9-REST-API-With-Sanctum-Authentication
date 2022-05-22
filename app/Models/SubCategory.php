<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

      protected $fillable = [
        'category_id',
        'sub_category_name_en',
        'sub_category_name_tr',
        'sub_category_slug_en',
        'sub_category_slug_tr',
    ];
}
