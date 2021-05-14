<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth ;

class LoginController extends Controller
{

  public function __construct()
  {
          $this->middleware('guest')->except('logout');
          $this->middleware('guest:administrator')->except('logout');
          $this->middleware('guest:evaluator')->except('logout');
          $this->middleware('guest:contestant')->except('logout');
  }

  // ADMIN

  public function showAdminLoginForm()
  {
      return view('auth.login',['url'=>'administrator']);
  }

  public function loginAdmin(Request $request)
  {
      //validate
      $this->validate($request,[
        'email' => 'required | email',
        'password'=> 'required'
      ]);
      //sign in the admin
      if(Auth::guard('administrator')->attempt($request->only('email','password'))){
          return redirect()->route('/');
      };
      return back()->with('status','Invalid login credentials');
  }
}
