<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
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
