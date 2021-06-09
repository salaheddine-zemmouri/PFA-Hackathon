<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Objective;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ObjectiveController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($competition_id)
    {
        $competition = Competition::find($competition_id);

        if(Auth::guard('administrator')->check()){
            $admin = Auth::guard('administrator')->user();
            $objectives = $competition->objectives()
                    ->orderBy('created_at','desc')
                    ->paginate(8);

            return view('admin.objectives',[
                'objectives' => $objectives,
                'admin' => $admin,
                'competition' => $competition,
            ]);
        }
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
    public function store(Request $request, $competition_id)
    {
        //validation
        $validator = Validator::make($request->all(), [
            'objective' => 'bail|required',
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()]);
        }else{
            $competition = Competition::find($competition_id);
            $objective = new Objective();

            $objective->title = $request->input('objective');
            $objective->administrator_id = Auth::guard('administrator')->user()->id;
            $objective->competition()->associate($competition)->save();

            return response()->json(['success' => '1']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Objective  $objective
     * @return \Illuminate\Http\Response
     */
    public function show(Objective $objective)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Objective  $objective
     * @return \Illuminate\Http\Response
     */
    public function edit(Objective $objective)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Objective  $objective
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Objective $objective)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Objective  $objective
     * @return \Illuminate\Http\Response
     */
    public function destroy(Objective $objective)
    {
        //
    }
}
