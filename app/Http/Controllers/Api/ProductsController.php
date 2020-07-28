<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function create(Request $request){
      $product = new Product;
      $product->name = $request->name;
        $product->description = $request->description ;
        $product->price = $request->price;
//        $product->category = $request->category;
//        $product->featured = $request->featured;
//        if ($request->hasFile('photo')){
////            getfilenamewithextensions
//            $filenamewithext =  $request->file('photo')->getClientOriginalName();
//            $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);
//            $extension = $request->file('photo')->getClientOriginalExtension();
//            $filenametostore = $filename.'_'.time().'.'.$extension;
//            $path = $request->file('photo')->storeAs('public/products', $filenametostore);
//
//        }else{
//            $filenametostore='noimage.jpg';
//
//        }
        if ($request->photo !='' ){
            $photo = time().'jpg';
            file_put_contents('storage/products'.$photo,base64_decode($request->photo));
            $product->photo=$photo;

        }else{
            $photo='noimage.jpg';
            $product->photo=$photo;

        }
        $product->save();
        return response()->json([
           'success'=>true,
           'message'=>'Created',
           'product'=>$product
        ]);
    }
    public function update(Request $request){
        $product = Product::find($request->id);
//        if (Auth::user()->id!=$request->id){
//
//        }
        $product->name = $request->name;
        $product->description = $request->description ;
        $product->price = $request->price;
        if ($request->photo !=''){
            if ($product->photo!='noimage.jpg'){
            Storage::delete('public/products/'.$product->photo);}
            $photo = time().'jpg';
            file_put_contents('storage/products'.$photo,base64_decode($request->photo));
            $product->photo=$photo;

        }
        $product->update();
        return response()->json([
            'success'=>true,
            'message'=>'Updated',

        ]);
    }
    public function delete(Request $request){
        $product = Product::find($request->id);
//        if (Auth::user()->id!=$request->id){
//
//        }


            if ($product->photo!='noimage.jpg'){
                Storage::delete('public/products/'.$product->photo);}
            $product->delete();


        return response()->json([
            'success'=>true,
            'message'=>'Deleted',

        ]);
    }
    public function products(){
        $products = Product::orderBy('id','asc')->get();
        foreach ($products as $product){
            $product['reviewsCount']=count($product->reviews);
        }

        return response()->json([
            'success'=>true,

            'products'=>$products

        ]);

    }
    public function productsSpec(Request $request){
        $products = Product::find($request->id);

        return response()->json([
            'success'=>true,

            'products'=>$products

        ]);

    }
//    public function create(Request $request){}
//    public function create(Request $request){}
//    public function create(Request $request){}

}
