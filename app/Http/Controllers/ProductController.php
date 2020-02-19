<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use File;
use Auth;
class ProductController extends Controller
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


    public function product_search(Request $request)
    {
       $catagory=$request->product_catagory;
       $value=$request->search_key;
       if($catagory=='0'){
         $flights = Product::where('title', 'LIKE', '%'.$value.'%')->where('product_status',1)
         ->get();
         if(count($flights) > 0){
             return view('user.search', compact('flights'));
         }else {
           return view('user.404');
         }
       }//outer if
       else{
         $flights = Product::where('title', 'LIKE', '%'.$value.'%')
         ->where('product_catagory',$catagory)->where('product_status',1)
         ->get();
         if(count($flights) > 0){
             return view('user.search', compact('flights'));
         }else {
           return view('user.404');
         }
       }//outer else


    }
    public function inactive_product($id)
    {


        $ban = Product::find($id);
      if($ban->product_status == '0'){
          $ban->product_status = '1';
          $ban->save();
          return redirect('/product_list')->with('status','Product Successfully Activated');
      }
      else{
        $ban->product_status = '0';
        $ban->save();
        return redirect('/product_list')->with('status','Product Successfully Inactivated');
      }
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

         'cover_image' => 'required| mimes:jpeg,jpg,png',
         'other_image' => 'required| mimes:jpeg,jpg,png',

     ]);

        if ($file = $request->file('cover_image')){
           $photo = time().'_'.$request->file('cover_image')->getClientOriginalName();
           $photo = str_replace(' ', '_', $photo);
           $file->move('product_image',$photo);
          }
        if ($r_file = $request->file('other_image')){
            $name_file = time().'_'.$request->file('other_image')->getClientOriginalName();
            $name_file = str_replace(' ', '_', $name_file);
            $r_file->move('other_image',$name_file);

            }

        $add = new Product;
        $add->user_id=Auth::id();
        $add->product_catagory = $request->product_catagory;
        $add->title = $request->product_name;
        $add->description = $request->product_des;
        $add->num_days = $request->num_days;
        $add->cover_image =$photo;
        $add->other_image =$name_file;
        $add->save();
        return redirect('/product_list')->with('success','Product Successfully Added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $userdata = Product::findOrFail($id);
      return view('user.product.edit_product', compact('userdata'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
                $id=$request->product_id;
              // //delete existing image and file
              $userdata = Product::findOrFail($id);

              if($request->file('cover_image')!=null){
                $image_name = $userdata->cover_image;
                $image_name='product_image/'.$image_name;
                File::delete($image_name);

                $request->validate([
                     'cover_image' => 'required| mimes:jpeg,jpg,png',

               ]);

               if ($file = $request->file('cover_image')){
                $photo = time().'_'.$request->file('cover_image')->getClientOriginalName();
                $photo = str_replace(' ', '_', $photo);
                $file->move('product_image',$photo);
                  }
              }//cover imagear
              else{
                $photo=$userdata->cover_image;
              }

              if($request->file('other_image')!=null){
                $file_name = $userdata->other_image;
                $file_name='other_image/'.$file_name;
                File::delete($file_name);
                $request->validate([
                     'other_image' => 'required| mimes:jpeg,jpg,png',
               ]);

               if ($r_file = $request->file('other_image')){
                $name_file = time().'_'.$request->file('other_image')->getClientOriginalName();
                $name_file = str_replace(' ', '_', $name_file);
                $r_file->move('other_image',$name_file);

                }
              }//other image
              else{
                $name_file=$userdata->other_image;
              }
              $userdata->product_catagory = $request->product_catagory;
              $userdata->title = $request->product_title;
              $userdata->description = $request->product_des;
              $userdata->num_days = $request->num_days;
              $userdata->cover_image =$photo;
              $userdata->other_image =$name_file;
              $userdata->save();
              return redirect('/product_list')->with('success','Product Successfully Updated');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       //delete existing image and file
        $userdata = Product::findOrFail($id);

        $image_name = $userdata->cover_image;
        $image_name='product_image/'.$image_name;
        File::delete($image_name);

        $file_name = $userdata->other_image;
        $file_name='other_image/'.$file_name;
        File::delete($file_name);
        $userdata->delete();
        return redirect('/product_list')->with('success','Product Successfully Deleted');
    }
}
