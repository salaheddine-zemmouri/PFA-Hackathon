@extends('layouts.contestant-layout')

@section('actions')

@endsection

@section('customised-msg')

@endsection

@section('content')


<div class="col-md-9">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Add Project</h4>
        </div>
        <div class="card-body">
            <form id="add_project_form" method="POST" action="{{route('competitions.teams.projects.store',[$competition->id,$team->id])}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="project_name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" id="project_name" value="">
                    @error('name')
                        <span class="invalid-feedback">
                            <strong id="name_error">{{ $message }}</strong>
                        </span> 
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="project_desc" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="project_desc" rows="5" name="description"></textarea>
                    @error('description')
                        <span class="invalid-feedback">
                            <strong id="description_error">{{ $message }}</strong>
                        </span> 
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="project_file" class="form-label">Upload File</label>
                    <input class="form-control @error('description') is-invalid @enderror" type="file" id="project_file" name="file">
                    @error('file')
                        <span class="invalid-feedback">
                            <strong id="file_error">{{ $message }}</strong>
                        </span> 
                    @enderror
                </div>

                <div class="text-center">
                    <button class="btn btn-success m-4 mb-1" type="submit">
                        <i class="fas fa-lock"></i> Save Changes
                    </button>
                    <a href="" class="btn btn-danger m-4 mb-1">
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