<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Auth;
use DB;

class OrderController extends Controller
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


    public function create()
    {
        //
    }


    public function add_order(Request $request)
    {
        if (Auth::check()) {

            $product_id=$request->input('product_id');
            $owner_id=$request->input('owner_id');
            $buyer_id=Auth::id();
            $duration=$request->input('duration');;
            $order_date=date('Y-m-d');
            $expire_date=date('Y-m-d', strtotime($order_date. ' + '.$duration.' days'));
            $order=new Order();
            $order->product_id=$product_id;
            $order->owner_id=$owner_id;
            $order->buyer_id=$buyer_id;
            $order->take_date=$order_date;
            $order->expire_date=$expire_date;
            if($owner_id==$buyer_id){
                return redirect('/home')->with('error','You can not order own product');
            }else{
                $order->save();
                //update product status
                DB::table('products')->where('id', $product_id)->update(['product_status' => 0]);
                return redirect('/order_list')->with('status','Order Successfully Added');
            }


        }else{
            return redirect('/login');
        }
    }


    public function show(Order $order)
    {
        //
    }

    public function edit(Order $order)
    {
        //
    }


    public function update(Request $request, Order $order)
    {
        //
    }


    public function destroy(Order $order)
    {
        //
    }
}
