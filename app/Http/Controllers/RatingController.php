<?php

namespace App\Http\Controllers;

use App\Rating;
use App\Order;
use Illuminate\Http\Request;
use Auth;
use DB;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function rate_to_buyer(Request $request)
    {
       $user_id=$request->input('to_user_id');
       $rate_details=$request->input('rate_details');
       $adder=Auth::id();
       $order_id=$request->input('order_id');
       $rate=$request->input('rating');
        if($rate==null){
            $rate=1;
        }
        //add data to rating
        $rating=new Rating();
        $rating->user_id=$user_id;
        $rating->adder_id=$adder;
        $rating->rate_value=$rate;
        $rating->rate_details=$rate_details;
        $rating->save();
        //update order table
        DB::table('orders')->where('o_id', $order_id)->update(['status_order' => 2]);
        return redirect('/manage_order')->with('status',' Successfully Added');

    }

    public function rate_to_owner(Request $request)
    {
        $user_id=$request->input('to_user_id');
        $rate_details=$request->input('rate_details');
        $adder=Auth::id();
        $order_id=$request->input('order_id');
        $rate=$request->input('rating');
        if($rate==null){
            $rate=1;
        }
        //add data to rating
        $rating=new Rating();
        $rating->user_id=$user_id;
        $rating->adder_id=$adder;
        $rating->rate_value=$rate;
        $rating->rate_details=$rate_details;
        $rating->save();
        //update order table
        DB::table('orders')->where('o_id', $order_id)->update(['status_order' => 2]);
        return redirect('/order_list')->with('status',' Successfully Added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function edit(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rating $rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rating $rating)
    {
        //
    }
}
