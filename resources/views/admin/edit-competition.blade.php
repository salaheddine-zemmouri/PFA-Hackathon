@extends('layouts.dashboard-layout')

@section('actions')

@endsection

@section('customised-msg')

@endsection

@section('content')
<div class="col-md-9">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Edit competition</h4>
        </div>
        <div class="card-body">
            <form id="edit_homework_form" method="POST" action="{{route('competitions.update',$competition->id)}}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="comp_name">Name</label>
                    <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" id="comp_name" value="{{ old('name',$competition->name) }}">
                    @error('name')
                    <span class="invalid-feedback">
                        <strong id="name_error">{{ $message }}</strong>
                    </span> 
                    @enderror
                </div>
                <div class="form-group">
                    <label for="start_date">Start date</label>
                    <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date',$competition->start_date) }}">
                    @error('start_date')
                    <span class="invalid-feedback">
                        <strong id="start_date_error">{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="end_date">End date</label>
                    <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date', $competition->end_date) }}">
                    @error('end_date')
                    <span class="invalid-feedback">
                        <strong id="end_date_error">{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <hr>
                <div class="text-center">
                    <button class="btn btn-success" type="submit">
                        <i class="fas fa-lock"></i> Save Changes
                    </button>
                    <a href={{route('competitions.index')}} class="btn btn-danger">
                        <i class="fas fa-trash"></i> Discard Changes
                    </a>
                </div>
            </form>
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