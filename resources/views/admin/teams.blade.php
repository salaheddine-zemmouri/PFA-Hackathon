@extends('layouts.admin-layout')

@section('title')
<title>Hackathon - Teams</title>
@endsection

@section('actions')
<div class="col-md-4 offset-4">
    <input type="text" name="search" id="search" class="form-control shadow" placeholder="Search">
</div>
@endsection

@section('content')
<div class="col-md-9">
    <input type="hidden" name="competition-id" id="competition-id" value="{{$competition->id}}">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Teams</h4>
        </div>
        <table class="table table-hover" id="datatable-confirmed">
            <thead class="thead-light table-secondary">
                <tr>
                    <th></th>
                    <th>Team Name</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($teams as $team)
                <tr>
                    <td>
                        <input type="hidden" id="team-id" name="team-id" value="{{ $team->id }}">
                    </td>
                    <td>{{ $team->name }}</td>
                    <td>
                        <a href="{{ route('competitions.teams.show',[$competition->id,$team->id]) }}" class="btn btn-light view-team">
                            <i class="fas fa-info-circle"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3">
                        No data found!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="pagination justify-content-center">
            
        </div>
    </div>
</div>
@endsection

@section('customised-modal')
    
@endsection

@section('customised-js')
    
@endsection