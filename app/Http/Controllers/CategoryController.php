<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use GuzzleHttp\Psr7\Response;
use Intervention\Image\Facades\Image;

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
                'category_name_tr.required' => 'Yazmayı Unuttun, ?'
            ]
        ]);
    
        $image = $request->file('image_url');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(400,400)->save('upload/category_image/'.$name_gen);
        Category::create([
        'category_name_en' => $request->category_name_en,
        'category_name_tr' => $request->category_name_tr,
        'category_slug_en' => strtolower(str_replace(' ','-',$request->category_name_en)),
        'category_slug_tr' => strtolower(str_replace(' ','-',$request->category_name_tr)),
        'category_icon' => $request->category_icon,
        'image_url' =>  url('/upload/category_image').'/'.$name_gen, // Esy
        ]);
        return response('╾━╤デ╦︻', 200);
}

         public function update(Request $request, $id) {
         $request->validate([
            'image_url' => 'required',
            'category_name_en' => 'required',
            'category_name_tr' => 'required',
            'category_icon' => 'required',
            [
                'category_name_en.required' => 'Input Category English',
                'category_name_tr.required' => 'Yazmayı Unuttun, ?'
            ]
        ]);
    

        $image = $request->file('image_url');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(400,400)->save('upload/category_image/'.$name_gen);
        Category::findOrFail($id)->update([
        'category_name_en' => $request->category_name_en,
        'category_name_tr' => $request->category_name_tr,
        'category_slug_en' => strtolower(str_replace(' ','-',$request->category_name_en)),
        'category_slug_tr' => strtolower(str_replace(' ','-',$request->category_name_tr)),
        'category_icon' => $request->category_icon,
        'image_url' =>  url('/upload/category_image').'/'.$name_gen,
        ]);

        return response([
            'status' => '201 Created 🐶'
        ]);

    }

    public function search($id) {
        $data = SubCategory::where('category_id', '=', $id)->get();
        return response([
        'data' => $data,
    ]);
    }

    public function destroy($id)
    {
       return Category::destroy($id);
    }
}
