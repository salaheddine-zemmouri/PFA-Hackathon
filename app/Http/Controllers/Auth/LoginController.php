<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Auth ;

class LoginController extends Controller
{



  public function index()
  {
      return view('auth.login');
  }

  public function loginUser(Request $request)
  {
    
      //validate
      $this->validate($request,[
        'radio' => 'required',
        'email' => 'required | email',
        'password'=> 'required'
      ]);

      //sign in the user
      $credentials = $request->only('email', 'password');

      if(!Auth::guard($request->radio)->attempt($credentials)){
          return back()->with('status','Invalid login credentials');
      };
      //return redirect()->route('dashboard',['user'=>$request->radio]);
      return redirect()->route('competitions.index');


  }
}
