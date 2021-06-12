<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\CompetitionEvaluatorObjective;
use App\Models\Evaluator;
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
            $evaluators = $competition->evaluators;

            return view('admin.objectives',[
                'objectives' => $objectives,
                'admin' => $admin,
                'competition' => $competition,
                'evaluators' => $evaluators,
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
            'objective' => 'required',
            'evaluator' =>'required',
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()]);
        }else{
            //$competition = Competition::find($competition_id);
            $evaluator_id = $request->input('evaluator');
            $subscription =  CompetitionEvaluatorObjective::where('competition_id',$competition_id)->where('evaluator_id',$evaluator_id)->first();
            //dd($subscription->objective_id);
            $objective = new Objective();

            $objective->title = $request->input('objective');
            $objective->administrator_id = Auth::guard('administrator')->user()->id;
            $objective->save();
            
            if($subscription->objective_id != null){
                CompetitionEvaluatorObjective::create([
                    'competition_id' => $competition_id,
                    'evaluator_id' => $evaluator_id,
                    'objective_id' => $objective->id,
                ]);
            }else{
                $subscription->objective_id = $objective->id;
                $subscription->save();
            }

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
    public function update(Request $request, $competition_id, $objective_id)
    {
        //validation
        $validator = Validator::make($request->all(), [
            'new_objective' => 'bail|required',
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()]);
        }else{
            $competition = Competition::find($competition_id);
            $objective = Objective::find($objective_id);

            $objective->title = $request->input('new_objective');
            $objective->administrator_id = Auth::guard('administrator')->user()->id;
            $objective->competition()->associate($competition)->save();

            return response()->json(['success' => '1']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Objective  $objective
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $competition_id, $objective_id)
    {
        $objective = Objective::find($objective_id);
        $subscription = CompetitionEvaluatorObjective::where('competition_id',$competition_id )
                                        ->where('objective_id',$objective_id)->first();
        
        $subscription->objective_id = null;
        $subscription->save();
        $objective->delete();
        $request->session()->flash('objective_deleted', 'Record successefully deleted');
        return redirect()->route('competitions.objectives.index',$competition_id);
    }
}
