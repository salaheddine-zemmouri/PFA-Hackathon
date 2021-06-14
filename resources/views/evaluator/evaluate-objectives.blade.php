@extends('layouts.evaluator-layout')

@section('title')
<title>Hackathon - Evaluate Objectives</title>
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

    <div class="alert alert-danger fade show" role="alert" id="success-msg" style="display: block;">
        <strong>All marks must be out of 5 (mark/5)</strong>
    </div>

    {{-- Objectives Datatable --}}
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Evaluate Objectives</h4>
            <h6>{{$objective->title}}</h6>
        </div>
        <table class="table table-hover" id="datatable">
            <thead class="thead-light table-secondary">
                <tr>
                    <th></th>
                    <th>Team</th>
                    <th colspan="2">Mark</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($teams as $team)
                <tr>
                    <td>
                        <input type="hidden" id="team-id" name="team-id" value="{{ $team->id }}">
                    </td>
                    <td>{{ $team->name }}</td>
                    <form action="{{ url('/evaluate/'.$team->id.'/objective/'.$objective->id) }}" method="post">
                        @csrf
                        <div class="input-group">
                            <td>
                                @if ($objective->validatedObjectives()->where('team_id',$team->id)->first() != null)
                                <input type="number" step="1"  min="0" max="5" class="form-control @error('mark') is-invalid @enderror" name="mark" value="{{ old('mark', $objective->validatedObjectives()->where('team_id',$team->id)->first()['note']) }}">
                                @else
                                <input type="number" step="1"  min="0" max="5" class="form-control @error('mark') is-invalid @enderror" name="mark" value="{{ old('mark') }}">
                                @endif
                                @error('mark')
                                <span class="invalid-feedback">
                                    <strong id="mark_error">{{ $message }}</strong>
                                </span> 
                                @enderror
                            </td>
                            <td>
                                <span class="input-group-btn">
                                    <button class="btn btn-success" type="submit">Save</button>
                                </span>
                            </td>
                        </div>
                    </form>
                </tr>
                @empty
                <tr>
                    <td colspan="4">
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