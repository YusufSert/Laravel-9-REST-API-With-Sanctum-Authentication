<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    //
    public function index() {
        $data = SubCategory::all();
        if($data == null)
        {
            return response([
                'status' => '404'
            ]);
        }
        return response([
            'status' => '200',
            'data' => $data
        ]);
    }


    public function show($id) {
        $data = SubCategory::find($id);
        if($data == null){return response(['status'=>'success', 'data' => '404']);}
        return response([
            'status' => '200',
            'data' => $data,
        ]);

    }

    public function addSubCategory(Request $request) {
        $request->validate([
            'category_id' => 'required|exists:App\Models\Category,id',
            'sub_category_name_en' => 'required',
            'sub_category_name_tr' => 'required',
            //'category_id' => 'required',
        ]);
       
        SubCategory::create([
            'category_id' => $request->category_id,
            'sub_category_name_en' => $request->sub_category_name_en,
            'sub_category_name_tr' => $request->sub_category_name_tr,
            'sub_category_slug_en' => strtolower(str_replace(' ', '-', $request->sub_category_name_en)),
            'sub_category_slug_tr' => strtolower(str_replace(' ', '-', $request->sub_category_name_tr)),
        ]);

         return response([
            'status' => '200'
        ]);
    }


    public function update(Request $request, $id) {
        $request->validate([
            'category_id' => 'required|exists:App\Models\Category,id',
            'sub_category_name_en' => 'required',
            'sub_category_name_tr' => 'required',
        ]);
        if($data = SubCategory::find($id))
        {
        $data->update([
        'category_id' => $request->category_id,
        'sub_category_name_en' => $request->sub_category_name_en,
        'sub_category_name_tr' => $request->sub_category_name_tr,
        'sub_category_slug_en' => strtolower(str_replace(' ','-',$request->sub_category_name_en)),
        'sub_category_slug_tr' => strtolower(str_replace(' ','-',$request->sub_category_name_tr)),
        ]);
         return response([
            'status' => '200'
        ]);        
        }
        else
        {
            return response([
                'status' => '404'
            ]);
        }
       

    }

    public function search($id) {
    $data = Product::where('sub_category_id', '=', $id)->get(); // gets all the products sub_category_id reqested id
    if(!count($data)){return response(['status'=>'404']);}

    return response([
        'status' => '200',
        'id' => $id,
        'data' => $data
    ]);
    }

    public function destroy($id)
    {
       if( SubCategory::destroy($id))
        {
            return response([
                'status' => '200'
            ]);
        }
        else{
             return response([
                 'status' => '404'
             ]);
         }
      
    }
}

