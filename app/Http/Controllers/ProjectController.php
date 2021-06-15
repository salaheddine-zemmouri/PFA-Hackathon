<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Team;
use App\Models\File;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        if(Auth::guard('contestant')->check()){
            $contestant = Auth::guard('contestant')->user();
            return view('contestant.project',[
                'team' => $team,
                'competition' => $competition,
                'contestant' => $contestant,
                'active' => 'project'
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
                'user' => $contestant,
                'competition' => $competition,
                'team' => $team,
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
            $filePath = $request->file('file')->storeAs('public/uploads', $fileName);
            $file_id = DB::table('files')->insertGetId(
                ['file_path' => $filePath]
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
            return back()
                ->with('success','Project submitted Succefully');
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
