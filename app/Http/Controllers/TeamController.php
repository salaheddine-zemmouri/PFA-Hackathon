<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Contestant;
use App\Models\Competition;
use App\Models\Participant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TeamSubscription;
use App\Mail\ContestantAlertMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContestantInvitationMail;


class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($competition_id)
    {
        $competition = Competition::find($competition_id);
        $participations = Participant::where('competition_id',$competition_id)->get();
        
        $teams = [];
        $i = 0;
        foreach ($participations as $participation) {
            $teams[$i++] = Team::find($participation->team_id);
        }

        /*foreach($teams as $team){
            dd($team->projects()->where('competition_id',2)->get());
        }*/
        //dd($competition->participants()->where('team_id',4)->first()['project_id']);

        if(Auth::guard('administrator')->check()){
            $admin = Auth::guard('administrator')->user(); 
            return view('admin.teams',[
                'teams' => $teams,
                'admin' => $admin,
                'competition' => $competition,
                'active' => 'teams'
            ]);
        }elseif(Auth::guard('evaluator')->check()){
            $evaluator = Auth::guard('evaluator')->user();
            return view('evaluator.teams',[
                'teams' => $teams,
                'evaluator' => $evaluator,
                'competition' => $competition,
                'active' => 'teams'
            ]);
        }elseif(Auth::guard('contestant')->check()){
            $contestant = Auth::guard('contestant')->user();
            return view('contestant.teams',[
                'teams' => $teams,
                'contestant' => $contestant,
                'competition' => $competition,
                'active' => 'teams'
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
                if($user == null){
                    $password = Str::random(15);
                    Contestant::create([
                        'name' => $key,
                        'email' => $key,
                        'password' => Hash::make($password),
                    ]);
                    $user = DB::table('contestants')->where('email','=',$key)->first();
                    // sending invitation to the contestant by email
                    $details=[
                        'team_name' => $request->name,
                        'contestant_email' => $key,
                        'contestant_password' => $password,
                    ];

                    Mail::to($key)->send(new ContestantInvitationMail($details));
                }else{
                    $details=[
                        'team_name' => $request->name,
                    ];

                    Mail::to($key)->send(new ContestantAlertMail($details));
                }
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
