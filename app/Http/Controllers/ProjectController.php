<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Team;
use App\Models\Project;
use App\Models\Competition;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Models\TeamSubscription;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($competition_id,$team_id)
    {
        $competition = Competition::find($competition_id);
        $team = Team::find($team_id);
        $project = Project::find(
                    Participant::where('competition_id',$competition_id)
                   ->where('team_id',$team_id)
                   ->first()->project_id); 
        if($project != null && $project->file_id != null)
            $file = File::find($project->file_id);
        else
            $file = null;
        if(Auth::guard('contestant')->check()){
            $contestant = Auth::guard('contestant')->user();
            $leader = TeamSubscription::where('contestant_id',$contestant->id)
                      ->where('team_id',$team_id)
                      ->first()->leader;
            return view('contestant.project',[
                'team' => $team,
                'competition' => $competition,
                'contestant' => $contestant,
                'leader' => $leader,
                'project' => $project,
                'active' => 'project',
                'file' => $file,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($competition_id,$team_id)
    {
        if(Auth::guard('contestant')->check()){
            $competition = Competition::find($competition_id);
            $team = Team::find($team_id);
            $contestant = Auth::guard('contestant')->user();
            return view('contestant.add-project',[
                'contestant' => $contestant,
                'user' => $contestant,
                'competition' => $competition,
                'team' => $team,
                'active' => 'project'
            ]);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $competition_id , $team_id)
    {  
        // validation
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'file' => 'required|mimes:pdf,zip,rar'
        ]); 
        // store the file in Files
        if($request->hasFile('file')){
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $request->file('file')->move(public_path().'/uploads/', $fileName);
            $file_id = DB::table('files')->insertGetId(
                ['file_path' => $fileName]
            );
            
            // store project in Projects
            $project_id = DB::table('projects')->insertGetId(
                ['name' => $request->name,
                'description' => $request->description,
                'file_id' => $file_id,]
            ); 
            // update Participants
            DB::table('participants')
              ->where('competition_id', $competition_id)
              ->where('team_id',$team_id)
              ->update(['project_id' => $project_id]);
            //redirect
            $request->session()->flash('project_created', 'Project Submitted Succefully');
            return redirect()->route('competitions.teams.projects.index',[$competition_id,$team_id]);
        }
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
    public function update(Request $request,$competition_id , $team_id, $project_id)
    {
        // validation
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'file' => 'required|mimes:pdf,zip,rar'
        ]); 
        // store the file in Files
        if($request->hasFile('file')){
            $fileName = time().'_'.$request->file->getClientOriginalName();
            //$filePath = $request->file('file')->storeAs(public_path().'/uploads/', $fileName);
            $request->file('file')->move(public_path().'/uploads/', $fileName);
            $file_id = DB::table('files')->insertGetId(
                ['file_path' => $fileName]
            );
            
            // update project
            DB::table('projects')->where('id',$project_id)
                                 ->update(['name' => $request->name, 
                                           'description' => $request->description,
                                           'file_id' => $file_id]); 

            //redirect
            // $request->session()->flash('project_updated','Project Updated Succefully');
            return redirect()->route('competitions.teams.projects.index',[$competition_id,$team_id])->with('session','Project Updated Succefully');
        }
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

    public function downloadFile($project_id){
        $project = Project::find($project_id);
        $file = File::find($project->file_id);
        //dd($file);
        if($file != null){
            return response()->download(public_path('/uploads/'.$file->file_path));
        }
        //return response()->download(public_path('/homework_files/'.$fileName));
    }

    public function deleteFile($project_id){
        $project = Project::find($project_id);
        $file = File::find($project->file_id);
        $project->file_id = null;
        $project->save();
        $file->delete();
        return back();
    }
}
