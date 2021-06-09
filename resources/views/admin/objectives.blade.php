@extends('layouts.admin-layout')

@section('title')
<title>Hackathon - Objectives</title>
@endsection

@section('actions')
<div class="col-md-4 offset-1 d-grid gap-2">
    <a href="#" class="btn btn-success shadow" data-bs-toggle="modal" data-bs-target="#addObjectiveModal">
        <i class="fas fa-plus"></i> Add Objective
    </a>
</div>
<div class="col-md-4 offset-2">
    <input type="text" name="search" id="search" class="form-control shadow" placeholder="Search">
</div>
@endsection

@section('content')
<div class="col-md-9">
    <input type="hidden" name="competition-id" id="competition-id" value="{{ $competition->id }}">
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-msg" style="display: none;">
        <strong>Record added successfully</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Objectives</h4>
        </div>
        <table class="table table-hover" id="datatable">
            <thead class="thead-light table-secondary">
                <tr>
                    <th></th>
                    <th>Objective</th>
                    <th>Edit</th>
                    <th>Delete</th>
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
                        <a href="#" class="btn btn-light">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                    <td>
                        <a href="#" class="btn btn-light">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
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
<div class="modal fade" id="addObjectiveModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Objective</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="add-objective-form" method="POST" action="">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="objective">Objective</label>
                        <input type="text" name="objective" class="form-control" id="objective" value="{{ old('objective') }}">
                        <span class="invalid-feedback">
                            <strong id="obj-error"></strong>
                        </span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button name="add" class="btn btn-success" id="add" type="submit">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('customised-js')
<script type="text/javascript">
    $(document).ready(function(){
        // Get competition id
        var competition_id = document.getElementById("competition-id").value;

        if(localStorage.getItem("success")){
            $('#success-msg').css('display', 'block')
            localStorage.clear();
        }

        $('#add-objective-form').on('submit', function(e){
            e.preventDefault();
            $('#obj-error').html("");
            $('#objective').removeClass('is-invalid');
            $.ajax({
                type:'POST',
                url:'/competitions/'+competition_id+'/objectives',
                data:$('#add-objective-form').serialize(),
                dataType: 'json',
                success:function(data){
                    if(data.errors) {
                        if(data.errors.objective){
                            $('#obj-error').html(data.errors.objective[0]);
                            $('#objective').addClass('is-invalid');
                        }
                    }
                    if(data.success) {
                        $('#addObjectiveModal').modal('hide');
                        localStorage.setItem("success",data.OperationStatus)
                        window.location.reload();
                    }
                },
            })
        })
        //alert(1);
        /*var archiveButtons = document.getElementsByClassName('archive-class')
        for (let i = 0; i < archiveButtons.length; i++) {
            archiveButtons[i].addEventListener('click',archiveClass); 
        }*/
    })
</script>
@endsection