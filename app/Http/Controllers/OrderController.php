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
            $order->status_order=3;
            $order->take_date=$order_date;
            $order->expire_date=$expire_date;
            if($owner_id==$buyer_id){
                return redirect('/home')->with('error','You can not order own product');
            }else{
                $order->save();
                 //update product status
				 DB::table('products')->where('id', $product_id)->update(['product_status' => 0]);
                //add email
                //$get_email = DB::table('users')->where('id','=',$owner_id)->first();
                //add mail testing
                //$to_name =$get_email->name;
                //$to_email =$get_email->email;
                //$data = array('name'=>$get_email->name, "body" =>'You have a new order');
                //\Mail::send('emails.order', $data, function($message) use ($to_name, $to_email) {
                //$message->to($to_email, $to_name)
                //       ->subject('Product Shared Notification');
               //    $message->from('sm11935p@gmail.com','Product Shared Notification From Let-Share');
               // });
                //end add email
                
                return redirect('/order_list')->with('status','Order Successfully Added.Please Wait for owner Confirmation');
            }


        }else{
            return redirect('/login');
        }
    }


    public function accept($id)
    {
      DB::table('orders')->where('o_id', $id)->update(['status_order' => 1]);
      return redirect('/manage_order')->with('status','Order Successfully Accepted');
    }

    public function reject($id)
    {


      $order = DB::table('orders')->where('o_id', $id)->first();
       //get the product id and update status
       $product=DB::table('products')->where('id', $order->product_id)->first();
       $product_id=$product->id;
       DB::table('products')->where('id', $product_id)->update(['product_status' => 1]);
       //delete order
       DB::table('orders')->where('o_id', '=', $id)->delete();
       return redirect('/manage_order')->with('status','Order Successfully Rejected');
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
