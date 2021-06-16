@extends('layouts.contestant-layout')

@section('title')
<title>Hackathon - Objectives</title>
@endsection


@section('content')
<div class="col-md-9">
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
                    <th>Evaluator</th>
                    <th>Note</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($objectives as $objective)
                <tr>
                    <td>
                        <input type="hidden" id="objective-id" name="objective-id" value="{{ $objective->id }}">
                        <input type="hidden" id="evaluator-id" name="evaluator-id" value="{{ $objective->evaluators()->first()->id }}">
                    </td>
                    <td>{{ $objective->title }}</td>
                    <td>{{ $objective->evaluators()->first()->name }}</td>
                    <td>
                    
                        @if(App\Models\ValidatedObjective::where('objective_id',$objective->id)->where('team_id',$team->id)->first())
                            {{App\Models\ValidatedObjective::where('objective_id',$objective->id)->where('team_id',$team->id)->first()->note}}
                        @else
                            Not evaluated     
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">
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