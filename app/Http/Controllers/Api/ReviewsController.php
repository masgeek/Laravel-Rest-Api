<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewsController extends Controller
{
    public function create(Request $request){
        $review = new Review;
        $review->user_id= Auth::user()->id;
        $review->product_id=$request->id;
        $review->body=$request->body;
        $review->save();
        return response()->json([
            'success'=>true,
            'message'=>'Added Review',

        ]);


}
    public function update(Request $request){
        $review = Review::find($request->id);
        if ($review->user_id != Auth::user()->id ){
            return response()->json([
                'success'=>false,
                'message'=>'Unauthorized access',

            ]);
        }


        $review->body=$request->body;
        $review->update();
        return response()->json([
            'success'=>true,
            'message'=>'Review Edited',

        ]);


    }
    public function delete(Request $request){
        $review = Review::find($request->id);
        if ($review->user_id != Auth::user()->id ){
            return response()->json([
                'success'=>false,
                'message'=>'Unauthorized access',

            ]);
        }



        $review->delete();
        return response()->json([
            'success'=>true,
            'message'=>'Review Deleted',

        ]);


    }
    public function reviews(Request $request){
        $reviews = Review::where('product_id',$request->id)->get();
        foreach ($reviews as $review){
            $review->user;
        }

        return response()->json([
            'success'=>true,

            'reviews'=>$reviews

        ]);

    }
}
