<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function create(Request $request){
        $cart = new Cart;
        $quantity=$request->quantity;
        $priceper = $request->price_per_unit  ;

        $cart ->name = $request->name;
        $cart ->price_per_unit = $request->price_per_unit  ;
        $cart ->quantity = $request->quantity;

        $cart ->total_price = $quantity*$priceper;


        $cart->save();
        return response()->json([
            'success'=>true,
            'message'=>'Added to Cart',
            'cart'=>$cart
        ]);
    }
    public function update(Request $request){
        $cart = Cart::find($request->id);
        $quantity=$request->quantity;
        $priceper = $cart->price_per_unit  ;
        $total_price = $quantity*$priceper;


        $cart->quantity = $quantity;
        $cart->total_price=$total_price;


        $cart->update();
        return response()->json([
            'success'=>true,
            'message'=>'Cart Updated',

        ]);
    }
    public function delete(Request $request){
        $cart = Cart::find($request->id);
//        if (Auth::user()->id!=$request->id){
//
//        }



        $cart->delete();


        return response()->json([
            'success'=>true,
            'message'=>'Deleted Cart Item',

        ]);
    }
    public function clearCart(Request $request){
    Cart::truncate();

        return response()->json([
            'success'=>true,
            'message'=>'Cart cleared',

        ]);
    }
    public function carts(){
        $description='';
        $carts = Cart::orderBy('id','asc')->get();
        foreach ($carts as $cart){
            $description= $description.'Cart item:'.$cart->name.
                ','.'Total Price:Ksh.'.$cart->total_price.'('.$cart->price_per_unit.' each)'.
                ','.'Quantity:'.$cart->quantity.'|||';
        }

        $sum = DB::table("carts")->get()->sum("total_price");





        return response()->json([
            'success'=>true,

            'carts'=>$carts,
            'sum'=>$sum,
            'description'=>$description

        ]);

    }
//    public function productsSpec(Request $request){
//        $products = Product::find($request->id);
//
//        return response()->json([
//            'success'=>true,
//
//            'products'=>$products
//
//        ]);
//
//    }
//    public function create(Request $request){}
//    public function create(Request $request){}
//    public function create(Request $request){}
}
