@extends('layouts.contestant-layout')

@section('title')
<title>Hackathon - Teams</title>
@endsection

@section('actions')
<div class="col-md-4 offset-1 d-grid">
    <a href="{{route('competitions.teams.projects.create',[$competition->id,$team->id])}}" class="btn btn-success btn-block shadow @if($project || !$leader) disabled @endif">
        <i class="fas fa-plus"></i> Add Project
    </a>
</div>

<div class="col-md-4 offset-2">
    <form method="GET" action="">
        <div class="input-group">
            <input type="text" name="search" id="search" class="form-control shadow-sm" placeholder="Search">
            <span class="input-group-btn">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
            </span>
        </div>
    </form>
</div>
@endsection

@section('content')
@if (!$project)
<div class="alert alert-secondary alert-dismissible fade show" role="alert"> 
    <strong>No project found !</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@else
<div class="col-md-9">
    @if (session('project_created'))
        <div class="alert alert-success alert-dismissible fade show">
            <strong>{{ session('project_created') }}</strong>
        </div>
    @endif
    @if (session('project_updated'))
        <div class="alert alert-success alert-dismissible fade show">
            <strong>{{ session('project_updated') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Edit Project</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('competitions.teams.projects.update',[$competition->id,$team->id,$project->id])}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="project_name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" id="project_name" value="{{$project->name}}" @if(!$leader) disabled @endif>
                    @error('name')
                        <span class="invalid-feedback">
                            <strong id="name_error">{{ $message }}</strong>
                        </span> 
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="project_desc" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="project_desc" rows="5" name="description" @if(!$leader) disabled @endif>{{$project->description}}</textarea>
                    @error('description')
                        <span class="invalid-feedback">
                            <strong id="description_error">{{ $message }}</strong>
                        </span> 
                    @enderror
                </div>
                <div class="form-group mb-3">
                    @if ($file != null)
                        <table>
                            <tr>
                                <td>
                                    <input type="hidden" id="" name="project_id" value="{{$project->id}}">
                                </td>
                                <td><a href="#"><i class="far fa-file-alt"></i> {{$file->file_path}}</a></td>
                                <td></td>
                                <td>
                                    <a href="#" class="btn btn-danger @if(!$leader) disabled @endif" id="delete_file" data-bs-toggle="modal" data-bs-target="#deleteFileModal"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        </table>
                    @else
                    <label for="project_file" class="form-label">Upload File</label>
                    <input class="form-control @error('description') is-invalid @enderror" type="file" id="project_file" name="file" @if(!$leader) disabled @endif>
                    <small class="form-text text-muted">Authorized extensions : pdf,zip,rar</small>
                    @error('file')
                        <span class="invalid-feedback">
                            <strong id="file_error">{{ $message }}</strong>
                        </span> 
                    @enderror
                    @endif
                </div>

                <div class="text-center">
                    <button class="btn btn-success m-4 mb-1 " type="submit" @if(!$leader) disabled @endif>
                        <i class="fas fa-lock"></i> Save Changes
                    </button>
                    <a href="" class="btn btn-danger m-4 mb-1 @if(!$leader) disabled @endif">
                        <i class="fas fa-trash"></i> Discard Changes
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection

@section('custom-modal')
<div class="modal fade" id="deleteFileModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Do you really want to delete this file? This process cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-dark" data-bs-dismiss="modal">Back</button>
                <form id="delete-file-form" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button name="delete" class="btn btn-danger" id="delete" type="submit">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-js')
<script type="text/javascript">
    function deleteFile() {
        var tr = this.parentElement.parentElement;
        var project_id = tr.children[0].children[0].value;
    
        //Setting up the action for the delete form 
        document.getElementById("delete-file-form").action = "/delete-file/"+project_id;
    }
    $(document).ready(function(){
        document.getElementById('delete_file').addEventListener('click',deleteFile);
    })
</script>
@endsection