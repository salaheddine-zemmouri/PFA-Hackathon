@extends('layouts.evaluator-layout')

@section('title')
<title>Hackathon - Objectives</title>
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

    {{-- Objectives Datatable --}}
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Objectives</h4>
        </div>
        <table class="table table-hover" id="datatable">
            <thead class="thead-light table-secondary">
                <tr>
                    <th></th>
                    <th>Objective</th>
                    <th>Evaluate</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($objectives as $objective)
                <tr>
                    <td>
                        <input type="hidden" id="objective-id" name="objective-id" value="{{ $objective->id }}">
                    </td>
                    <td>{{ $objective->title }}</td>
                    <td>
                        <a href="#" class="btn btn-light evaluate-obj">
                            <i class="fas fa-info"></i>
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
            {{ $objectives->links() }}
        </div>
    </div>
</div>
@endsection

@section('customised-modal')
@endsection

@section('customised-js')
@endsection