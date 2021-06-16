<?php

namespace App\Http\Controllers;

use App\Models\Evaluator;
use App\Models\Competition;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\EvaluatorAlertMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\EvaluatorInvitationMail;
use Illuminate\Support\Facades\Validator;
use App\Models\CompetitionEvaluatorObjective;

class EvaluatorController extends Controller
{
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
            $evaluators = $competition->evaluators()->distinct()
                    ->orderBy('created_at','desc')
                    ->paginate(8);

            return view('admin.evaluators',[
                'evaluators' => $evaluators,
                'admin' => $admin,
                'competition' => $competition,
                'active' => 'evaluators',
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
            'name' => 'bail|required',
            'email' => 'bail|required||email',
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()]);
        }else{
            $email = $request->email;
            $evaluator = Evaluator::where('email',$email)->first();
            // checking if the evaluator exists already or not
            // if he doesn't exist we add him to the DB
            if($evaluator == null){
                $password = Str::random(15);
                $new_evaluator = Evaluator::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($password),
                ]);
                CompetitionEvaluatorObjective::create([
                    'competition_id' => $competition_id,
                    'evaluator_id' => $new_evaluator->id,
                ]);

                // sending alert invitation to the evaluator by email
                $details=[
                    'competition_name' => Competition::find($competition_id)->name,
                    'evaluator_email' => $email,
                    'evaluator_password' => $password,
                ];
        
                Mail::to($email)->send(new EvaluatorInvitationMail($details));
            }else{
                // if the evaluator exists we just add it to the competition_evaluator_objectives table
                CompetitionEvaluatorObjective::create([
                    'competition_id' => $competition_id,
                    'evaluator_id' => $evaluator->id,
                ]);
                // sending alert invitation to the evaluator by email
                $details=[
                    'competition_name' => Competition::find($competition_id)->name,
                ];
        
                Mail::to($email)->send(new EvaluatorAlertMail($details));
            }
            return response()->json(['success' => '1']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Evaluator  $evaluator
     * @return \Illuminate\Http\Response
     */
    public function show(Evaluator $evaluator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Evaluator  $evaluator
     * @return \Illuminate\Http\Response
     */
    public function edit(Evaluator $evaluator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Evaluator  $evaluator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evaluator $evaluator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Evaluator  $evaluator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $competition_id, $evaluator_id)
    {
        $subscriptions = CompetitionEvaluatorObjective::where('competition_id',$competition_id )
                                                        ->where('evaluator_id',$evaluator_id)->get();
        foreach ($subscriptions as $subscription) {
            $subscription->delete();
        }
        $request->session()->flash('evaluator_deleted', 'Record successefully deleted');
        return redirect()->route('competitions.evaluators.index',$competition_id);
    }
}
