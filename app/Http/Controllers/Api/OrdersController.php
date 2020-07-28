<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function create(Request $request){
        $order = new Order;
        $order->user_id= Auth::user()->id;
        $order->description=$request->description;
        $order->total_price=$request->total_price;
        $order->save();
        return response()->json([
            'success'=>true,
            'message'=>'Added order',

        ]);


    }
//    public function update(Request $request){
//        $order = order::find($request->id);
////        if ($order->user_id != Auth::user()->id ){
////            return response()->json([
////                'success'=>false,
////                'message'=>'Unauthorized access',
////
////            ]);
////        }
//
//
//        $order->body=$request->body;
//        $order->update();
//        return response()->json([
//            'success'=>true,
//            'message'=>'order Edited',
//
//        ]);
//
//
//    }
    public function delete(Request $request){
        $order = order::find($request->id);
        if ($order->user_id != Auth::user()->id ){
            return response()->json([
                'success'=>false,
                'message'=>'Unauthorized access',

            ]);
        }



        $order->delete();
        return response()->json([
            'success'=>true,
            'message'=>'order Deleted',

        ]);


    }
    public function orders(Request $request){
        $orders = order::where('user_id',Auth::user()->id)->get();
        foreach ($orders as $order){
            $order->user;
        }

        return response()->json([
            'success'=>true,

            'orders'=>$orders

        ]);

    }
}
