<?php

namespace App\Http\Controllers\Auth;

use Auth ;
use App\Models\Evaluator;
use App\Models\Contestant;

use Illuminate\Http\Request;
use App\Models\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate
        $this->validate($request,[
          'radio' => 'required',
          'name' => 'required',
          'email' => 'required | email',
          'password'=> 'required'
        ]);
        // create a user
        if($request->radio == 'administrator'){
          Administrator::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
          ]);
        }
        if ($request->radio == 'contestant') {
          Contestant::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
          ]);
        }
        // sign in the user
        $credentials = $request->only('email', 'password');
        auth()->guard($request->radio)->attempt($credentials);
        //redirect
          //return redirect()->route('dashboard',['user'=>$request->radio]);
          return redirect()->route('competitions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      if(Auth::guard('administrator')->check()){
        $user = Administrator::find($id);
      }elseif(Auth::guard('evaluator')->check()){
        $user = Evaluator::find($id);
      }elseif(Auth::guard('contestant')->check()){
        $user = Contestant::find($id);
      }
      return view('layouts.edit-profile',[
        'user' => $user,
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      //validate
      $this->validate($request,[
        'name' => 'required',
        'email' => 'required | email',
      ]);
      if(Auth::guard('administrator')->check()){
        $user = Administrator::find($id);
      }elseif(Auth::guard('evaluator')->check()){
        $user = Evaluator::find($id);
      }elseif(Auth::guard('contestant')->check()){
        $user = Contestant::find($id);
      }

      $user->name = $request->input('name');
      $user->email = $request->input('email');
      if($request->input('password') != null){
        $user->password = Hash::make($request->input('password'));
      }
      $user->save();
      $request->session()->flash('profile_edited', 'Profile successefully edited');
      return redirect()->route('competitions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
