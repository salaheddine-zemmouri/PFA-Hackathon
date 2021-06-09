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
    <input type="hidden" name="competition-id" id="competition-id" value="">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Confirmed Teams</h4>
        </div>
        <table class="table table-hover" id="datatable-confirmed">
            <thead class="thead-light table-secondary">
                <tr>
                    <th></th>
                    <th>Team name</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="hidden" id="team-id" name="team-id" value="">
                    </td>
                    <td>Team 1</td>
                    <td>
                        <a href="#" class="btn btn-light">
                            <i class="fas fa-info-circle"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="pagination justify-content-center">
            
        </div>
    </div>

    <div class="card shadow-sm mt-3">
        <div class="card-header">
            <h4>Waiting Teams</h4>
        </div>
        <table class="table table-hover" id="datatable-waiting">
            <thead class="thead-light table-secondary">
                <tr>
                    <th></th>
                    <th>Team name</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="hidden" id="waiting-team-id" name="waiting-team-id" value="">
                    </td>
                    <td>Team 1</td>
                    <td>
                        <a href="#" class="btn btn-light">
                            <i class="fas fa-info-circle"></i>
                        </a>
                    </td>
                </tr>
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