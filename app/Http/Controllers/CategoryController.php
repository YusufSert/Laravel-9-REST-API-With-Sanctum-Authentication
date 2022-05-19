<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use GuzzleHttp\Psr7\Response;

class CategoryController extends Controller
{
    //
    public function addCategory(Request $request) {
        $request->validate([
            'category_name_en' => 'required',
            'category_name_tr' => 'required',
            'category_icon' => 'required',
            [
                'category_name_en.required' => 'Input Category English',
                'category_name_tr.required' => 'Yazmayı Unuttun, Malmın ?'
            ]
        ]);
    
        Category::insert([
        'category_name_en' => $request->category_name_en,
        'category_name_tr' => $request->category_name_tr,
        'category_slug_en' => strtolower(str_replace(' ','-',$request->category_name_en)),
        'category_slug_tr' => strtolower(str_replace(' ','-',$request->category_name_tr)),
        'category_icon' => $request->category_icon,
        ]);
        return response(200);

}

    public function viewCategory() {
        $category = Category::latest()->get();
         $response = [
            'status' => '200 OK',
            'data' => $category
         ];
        return response($response);
    }

}