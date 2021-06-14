@extends('layouts.evaluator-layout')

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
    {{-- Get competition id --}}
    <input type="hidden" name="competition-id" id="competition-id" value="{{ $competition->id }}">

    {{-- Teams Datatable --}}
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Teams</h4>
        </div>
        <table class="table table-hover" id="datatable">
            <thead class="thead-light table-secondary">
                <tr>
                    <th></th>
                    <th>Teams</th>
                    <th>Download work</th>
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
                        <a href="#" class="btn btn-light download-work">
                            <i class="fas fa-download"></i>
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