<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

use App\Models\Competition;
use App\Models\Contestant;
use App\Models\Team;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guard('administrator')->check()){
            $admin = Auth::guard('administrator')->user();
            $competitions = Competition::where('administrator_id', $admin->id)->get();
            return view('admin.dashboard',[
                'competitions' => $competitions->sortByDesc('created_at'),
                'admin' => $admin,
            ]);
        }elseif (Auth::guard('contestant')->check()) {
            $participations = [];
            $competitions = [];
            $contestant = Auth::guard('contestant')->user();
            $teams = Contestant::find($contestant->id)->teams;
            foreach($teams as $team){
                $participations[$team->team_id] = Participant::where('team_id',$team->team_id)->first();
            }
            $i = 0;
            foreach($participations as $participation){
                $competitions[$i++] = Competition::where('id',$participation->competition_id)->first();
            }
            return view('contestant.dashboard',[
                'contestant' => $contestant,
                'competitions' => $competitions,
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
    public function store(Request $request)
    {
        //validation
        $validator = Validator::make($request->all(), [
            'name' => 'bail|required||max:100',
            'start_date' => 'bail|required||date||after_or_equal:today',
            'end_date' => 'bail|required||date||after_or_equal:start_date',
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()]);
        }else{
            $competition = new Competition();

            $competition->name = $request->input('name');
            $competition->start_date = $request->input('start_date');
            $competition->end_date = $request->input('end_date');
            $competition->code = Str::random(6);
            $competition->administrator_id = Auth::guard('administrator')->user()->id;

            $competition->save();

            return response()->json(['success' => '1']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function show(Competition $competition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function edit(Competition $competition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Competition $competition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Competition $competition)
    {
        //
    }


    public function join(Request $request){
        //validation
        $validated = $request->validate([
            'name' => 'bail|required|max:50',
            'code' => 'bail|required|max:6',
        ]);

        $team = Team::where('name',$request->name)->first();
        $competition = Competition::where('code', $request->code)->first();

        Participant::create([
            'competition_id' => $competition->id,
            'team_id' => $team->id
        ]);

        return back();
    }
}
