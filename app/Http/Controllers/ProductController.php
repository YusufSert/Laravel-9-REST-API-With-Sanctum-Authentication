<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use PhpParser\Node\Stmt\Return_;
use Intervention\Image\Facades\Image;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::all();
        $reponse = [
            'status' => '🟢 200-OKİdir',
            'data' => $data,
        ];
        return response($reponse);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'sub_category_id' => 'required|exists:App\Models\SubCategory,id',
        ]);

        $image = $request->file('image_url');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(400,400)->save('upload/product_images/'.$name_gen);
        $product =  Product::create([
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-',$request->name)),
            'description' => $request->description,
            'price' => $request->price,
            'image_url' => url('/upload/product_images').'/'.$name_gen, // Esy
            'sub_category_id' => $request->sub_category_id,
        ]);

         return response([
             'status' => '200  OKİ',
             'data' => $product,
         ]);
       

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data =  Product::find($id);
        if($data == null){return response(['status'=>'success', 'data' => '404 Not Found :(']);}
        return response([
            'status' => '🟢 200-OKS:)',
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) // put method is op
    {
        $product = Product::find($id);
        $product->update($request->all());
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       return Product::destroy($id);
    }

     /**
     * Search for a name
     * @param  int  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
       return Product::where('name', 'like', '%'.$name.'%')->get(); //Searche the elemen bt name// put like '%'naem'%' start with or end with
    }
}

