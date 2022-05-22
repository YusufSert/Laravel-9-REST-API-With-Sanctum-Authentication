<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use GuzzleHttp\Psr7\Response;

class CategoryController extends Controller
{
    //List all Categories
    public function index() {
        $data = Category::all();
        $reponse = [
            'status' => '200-OKİdir',
            'data' => $data,
        ];
        return response($reponse);
    }

    public function show($id) {
        $data = Category::find($id);
        if($data == null){return response(['status'=>'success', 'data' => '404 Not Found :(']);}
        return response([
            'status' => '200-OKS:)',
            'data' => $data,
        ]);

    }

    // Add category
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