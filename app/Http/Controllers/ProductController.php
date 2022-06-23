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
        if($data == null){return response(['status' => '404']);}
        $reponse = [
            'status' => '200',
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
            'image_url' => 'required',
        ]);

        $image = $request->file('image_url');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(600,500)->save('upload/product_images/'.$name_gen);
        $product =  Product::create([
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-',$request->name)),
            'description' => $request->description,
            'price' => $request->price,
            'image_url' => url('/upload/product_images').'/'.$name_gen, // Esy
            'sub_category_id' => $request->sub_category_id,
        ]);

         return response([
             'status' => '200',
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
        if($data == null){return response(['status'=>'404']);}
        return response([
            'status' => '200',
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
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'sub_category_id' => 'required|exists:App\Models\SubCategory,id',
            'image_url' => 'required',
        ]);

        $image = $request->file('image_url');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(600,500)->save('upload/product_images/'.$name_gen);
        Product::findOrFail($id)->update([
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-',$request->name)),
            'description' => $request->description,
            'price' => $request->price,
            'image_url' => url('/upload/product_images').'/'.$name_gen, // Esy
            'sub_category_id' => $request->sub_category_id,
        ]);

        // $product = Product::find($id);
        // $product->update($request->all());
        //return $product;

         return response([
            'status' => '200'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $data =  Product::find($id);
       if($data == null){return response(['status'=>'404']);}
       Product::destroy($id);
       return response([
           'status' => '200'
       ]);
    }

     /**
     * Search for a name
     * @param  int  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
       $data =  Product::where('name', 'like', '%'.$name.'%')->get(); //Searche the elemen bt name// put like '%'naem'%' start with or end with
       if(count($data) < 1){return response(['status' => '404']);}
       return response([
           'status' => '200',
           'data' => $data
       ]);
    }

    public function addPopular($id)
    {
        $data = Product::find($id);
        if($data == null)
        {
            return response([
                'status' => '404'
            ]);
        }else
        $data->update([
            'popular' => '1'
        ]);
        // Product::findOrFail($id)->update([
        //     'popular' => '1',
        // ]);
        return response([
            'status' => '200'
        ]);
    }

      public function removePopular($id)
    {
        // $data = Product::find($id);
        // Product::findOrFail($id)->update([
        //     'popular' => '0',
        // ]);
        // return response([
        //     'status' => '201 Created 🐸'
        // ]);

        $data = Product::find($id);
        if($data == null)
        {
            return response([
                'status' => '404'
            ]);
        }else
        $data->update([
            'popular' => '0'
        ]);
        // Product::findOrFail($id)->update([
        //     'popular' => '1',
        // ]);
        return response([
            'status' => '200'
        ]);
    }

    public function showPopular ()
    {
        $data = Product::where('popular', '=', '1')->get();
        if(count($data) < 1){ return response(['status' => '404']);}
        return response([
            'status' => '200 ok',
            'data' => $data,
        ]);
    }
    

}

