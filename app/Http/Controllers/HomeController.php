<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\Support\Facades\Validator;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
	protected function validator(array $data)
    {
        return Validator::make($data, [
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    public function edit_profile(Request $request)
  {

      $id = Auth::id();
      $ac = User::find($id);
      $mb=$request->input('phone');
      if($mb==''){
        $mb="N";
      }
      $ac->name = $request->input('name');
      $ac->email =$request->input('email');
      $ac->phone =$mb;
      $ac->address = $request->input('eventlocation');
      $ac->lat = $request->input('eventlat');
      $ac->long = $request->input('eventlong');
      if($request->input('password')!=Null){
          $ac->password = Hash::make($request->input('password'));
      }
      $ac->save();

      return redirect('/home')->with('status','Profile Successfully Updated');

  }


    public function bann_user($id)
    {
      $ban = User::find($id);
      if($ban->status == '0'){
          $ban->status = '1';
          $ban->save();
          return redirect('/manage_user')->with('status','User Successfully Activated');
      }
      else{
        $ban->status = '0';
        $ban->save();
        return redirect('/manage_user')->with('status','User Successfully Banned');
      }
    }

    public function del_user($id)
    {

      $ban = User::find($id);
      $ban->delete();
      return redirect('/manage_user')->with('status','User Successfully Deleted');

    }


}
