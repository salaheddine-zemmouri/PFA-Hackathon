<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Contestant;

use App\Models\Competition;
use App\Models\Participant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\CompetitionEvaluatorObjective;

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
                'user' => $admin,
            ]);
        }elseif (Auth::guard('contestant')->check()) {
            $participations = [];
            $competitions = array(array());
            $contestant = Auth::guard('contestant')->user();
            $teams = Contestant::find($contestant->id)->teams;
    
            foreach($teams as $team){
                $participations[$team->team_id] = Participant::where('team_id',$team->team_id)->get();
            }
            
            foreach($participations as $participation){
                $i=0;
                foreach($participation as $teamParticipation)
                    $competitions[$teamParticipation->team_id][$i++] = Competition::where('id',$teamParticipation->competition_id)->first();
            }
            //dd($competitions);
            return view('contestant.dashboard',[
                'contestant' => $contestant,
                'competitions' => $competitions,
                'user' => $contestant,
            ]);
        }elseif(Auth::guard('evaluator')->check()){
            $evaluator = Auth::guard('evaluator')->user();
            $competitions = $evaluator->competitions;
            return view('evaluator.dashboard',[
                'competitions' => $competitions->unique()->sortByDesc('created_at'),
                'user' => $evaluator,
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
    public function edit($competition_id)
    {
        $competition = Competition::find($competition_id);
        if(Auth::guard('administrator')->check()){
            $admin = Auth::guard('administrator')->user();
            return view('admin.edit-competition',[
                'competition' => $competition,
                'admin' => $admin,
                'user' => $admin,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $competition_id)
    {
        $request->validate([
            'name' => 'bail|required||max:100',
            'start_date' => 'bail|required||date||after_or_equal:today',
            'end_date' => 'bail|required||date||after_or_equal:start_date',
        ]);

        $competition = Competition::find($competition_id);
        $competition->name = $request->input('name');
        $competition->start_date = $request->input('start_date');
        $competition->end_date = $request->input('end_date');
        $competition->save();

        $request->session()->flash('competition_edited', 'Competition successefully edited');
        return redirect()->route('competitions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $competition_id)
    {
        $competition = Competition::find($competition_id);
        $competition->delete();
        $request->session()->flash('competition_deleted', 'Competition successefully deleted');
        return redirect()->back();
    }
    

    public function join(Request $request){
        //validation
        $validated = Validator::make($request->all(),[
            'name' => 'required|max:50',
            'code' => 'required|max:6',
        ]);
        if($validated->fails()){
            return response()->json(['errors' => $validated->errors()]);
        }else{
            $team = Team::where('name',$request->name)->first();
            $competition = Competition::where('code', $request->code)->first();
            
            $participant = Participant::where('competition_id',$competition->id)->where('team_id' , $team->id)->first();
            
            if($participant !== null){
                return response()->json(['exist' => '1']);
            }
            Participant::create([
                'competition_id' => $competition->id,
                'team_id' => $team->id,
                'project_id' => null,
            ]);
        }
        return response()->json(['success' => '1']);
    }
}
