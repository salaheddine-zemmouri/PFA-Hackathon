@extends('layouts.dashboard-layout')

@section('title')
<title>Hackathon - Dashboard</title>
@endsection

@section('actions')

@endsection

@section('customised-msg')
{{-- Success msg after profile edition --}}
@if (session()->has('profile_edited'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('profile_edited') }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@endsection

@section('content')
@foreach ($competitions as $competition)
<div class="col-lg-4 col-sm-6 mb-4">
    <div class="card h-80 shadow-sm">
        <div class="card-header">
            <h4 class="card-title">{{$competition->name}}</h4>
        </div>
        <div class="card-body">
            
            <p class="card-text">From : {{$competition->start_date}}</p>
            <p class="card-text">To : {{$competition->end_date}}</p>
            <table>
                <tr>
                    <td>
                        <input type="hidden" name="competition-id" id="competition-id" value="{{$competition->id}}">
                    </td>
                    <td>
                        <a href="{{ route('competitions.teams.index',$competition->id) }}" class="btn btn-primary">Visit</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endforeach
@endsection

@section('pagination')
    
@endsection

@section('customised-modal')

@endsection

@section('customised-js')
  
@endsection