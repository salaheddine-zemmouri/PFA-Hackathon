<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;

use Auth ;
use Illuminate\Support\Facades\Hash;

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

    // attempt to login the user
    if(!Auth::guard($request->radio)->attempt($credentials)){
      return back()->with('status','Invalid login credentials');
    };

    // // if the user is an evaluator and the default password is still "password"
    // // then redirect him to reset password page
    // if(Auth::guard('evaluator')->check() && $request->password === "password"){
    //   return redirect()->route('password.request',['']);
    // }

    // otherwise redirect to competitions homepage
    return redirect()->route('competitions.index');


  }
}
