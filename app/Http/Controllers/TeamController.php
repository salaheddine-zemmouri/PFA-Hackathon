<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Contestant;
use App\Models\Competition;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Models\TeamSubscription;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($competition_id)
    {
        if(Auth::guard('administrator')->check()){
            $admin = Auth::guard('administrator')->user();
            $competition = Competition::find($competition_id);
            $participations = Participant::where('competition_id',$competition_id)->get();
            $teams = [];
            $i = 0;
            foreach ($participations as $participation) {
                $teams[$i++] = Team::find($participation->team_id);
            }
            return view('admin.teams',[
                'teams' => $teams,
                'admin' => $admin,
                'competition' => $competition,
                'active' => 'teams'
            ]);
        }elseif(Auth::guard('evaluator')->check()){
            $evaluator = Auth::guard('evaluator')->user();
            $competition = Competition::find($competition_id);
            $participations = Participant::where('competition_id',$competition_id)->get();
            $teams = [];
            $i = 0;
            foreach ($participations as $participation) {
                $teams[$i++] = Team::find($participation->team_id);
            }
            return view('evaluator.teams',[
                'teams' => $teams,
                'evaluator' => $evaluator,
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
    public function store(Request $request)
    {
        //validation
        $validated = $request->validate([
            'name' => 'required|max:50|unique:teams',
        ]);
        
        Team::create([
             'name' => $request->name,
        ]);

        $i = 0;
        foreach($request->all() as $key){
            $i++;
            if($i>3){
                $user = DB::table('contestants')->where('email','=',$key)->first();
                $team = DB::table('teams')->where('name','=',$request->name)->first();
                TeamSubscription::create([
                    'contestant_id' => $user->id,
                    'team_id' => $team->id,
                    'leader' => (($i==4)?1:0),
                ]);
            }
        }
        
        return back();
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
        //
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
        //
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
