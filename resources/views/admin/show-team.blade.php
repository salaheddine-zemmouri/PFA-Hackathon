@extends('layouts.admin-layout')

@section('actions')

@endsection

@section('customised-msg')

@endsection

@section('content')
<div class="col-md-9">
     {{-- Evaluators Datatable --}}
     <div class="card shadow-sm">
        <div class="card-header">
            <h4>Show Team</h4>
        </div>
        <table class="table table-hover" id="datatable">
            <tbody>
                <tr>
                    <th class="thead-light">Team Name</th>
                    <td>{{$team->name}}</td>
                </tr>
                <tr>
                    <th colspan="2" class="thead-light">Members</th>
                </tr>
                @foreach ($members as $member)
                <tr>
                    <th class="thead-light"></th>
                    <td>{{$member->name}}</td>
                </tr>
                @endforeach
                <tr>
                    <th class="thead-light">Project</th>
                    <td>{{$project->name}}</td>
                </tr>
            </tbody>
        </table>
        <div class="pagination justify-content-center">
        </div>
    </div>
</div>
@endsection

@section('pagination')
    
@endsection

@section('customised-modal')

@endsection

@section('customised-js')

@endsection