@extends('layouts.contestant-layout')

@section('title')
<title>Hackathon - Teams</title>
@endsection

@section('actions')
<div class="col-md-4 offset-1 d-grid">
    <a href="{{route('competitions.teams.projects.create',[$competition->id,$team->id])}}" class="btn btn-success btn-block shadow">
        <i class="fas fa-plus"></i> Add Project
    </a>
</div>

<div class="col-md-4 offset-2">
    <form method="GET" action="">
        <div class="input-group">
            <input type="text" name="search" id="search" class="form-control shadow-sm" placeholder="Search">
            <span class="input-group-btn">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
            </span>
        </div>
    </form>
</div>
@endsection

@section('content')

@endsection

@section('customised-modal')
    
@endsection

@section('customised-js')
    
@endsection