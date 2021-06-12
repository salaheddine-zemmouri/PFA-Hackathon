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
    {{-- Get competition id --}}
    <input type="hidden" name="competition-id" id="competition-id" value="{{ $competition->id }}">

    {{-- Success msg on add --}}
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-msg" style="display: none;">
        <strong>Record added successfully</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    {{-- Success msg on delete --}}
    @if (session()->has('objective_deleted'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('objective_deleted') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- Success msg on edit --}}
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-msg-edit" style="display: none;">
        <strong>Record edited successfully</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

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
                    <td>{{ $objective->evaluators()->first()->name }}</td>
                    <td>
                        <a href="#" class="btn btn-light edit-obj" data-bs-toggle="modal" data-bs-target="#editObjectiveModal">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                    <td>
                        <a href="#" class="btn btn-light delete-obj" data-bs-toggle="modal" data-bs-target="#deleteObjectiveModal">
                            <i class="fas fa-trash"></i>
                        </a>
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
                    <div class="form-group">
                        <label for="evaluator">Evaluator</label>
                        <select name="evaluator" class="form-select" id="evaluator">
                            @if (old('evaluator') != '')
                            <option selected>{{old('evaluator')}}</option>
                            @else
                            <option selected disabled value="">Choose evaluator..</option>
                            @endif
                            @foreach ($evaluators as $evaluator)
                            <option value="{{$evaluator->id}}">{{$evaluator->name}}</option>
                            @endforeach
                        </select>
                        <span class="invalid-feedback">
                            <strong id="evaluator-error"></strong>
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

<div class="modal fade" id="deleteObjectiveModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Objective</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Do you really want to delete this record? This process cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-dark" data-bs-dismiss="modal">Back</button>
                <form id="delete-objective-form" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button name="delete" class="btn btn-danger" id="delete" type="submit">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editObjectiveModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Objective</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="edit-objective-form" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="hidden-obj-id" id="hidden-obj-id" value="">
                        <label for="obj-new">Objective</label>
                        <input type="text" name="new_objective" class="form-control" id="obj-new" value="{{ old('obj-new') }}">
                        <span class="invalid-feedback">
                            <strong id="obj-new-error"></strong>
                        </span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button name="edit" class="btn btn-success" id="edit" type="submit">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('customised-js')
<script type="text/javascript">

    function deleteObjective() {
        var competition_id = document.getElementById("competition-id").value;
        var tr = this.parentElement.parentElement;
        var objective_id = tr.children[0].children[0].value;

        //Setting up the action for the delete form 
        document.getElementById("delete-objective-form").action = "/competitions/"+competition_id+"/objectives/"+objective_id;
    }

    function editObjective(){
        var competition_id = document.getElementById("competition-id").value;
        var tr = this.parentElement.parentElement;
        var objective_id = tr.children[0].children[0].value;
        var objective_title = tr.children[1].innerHTML;

        // Set modal input value into the same value from the table
        document.getElementById("obj-new").value = objective_title;
        // Set hiddent input into <tr> id
        document.getElementById("hidden-obj-id").value = objective_id;
    }

    function clickOnDelete(){
        var deleteButtons = document.getElementsByClassName("delete-obj");
        for (let i = 0; i < deleteButtons.length; i++) {
            deleteButtons[i].addEventListener("click",deleteObjective);
        }
    }

    function clickOnEdit(){
        var editButtons = document.getElementsByClassName("edit-obj");
        for (let i = 0; i < editButtons.length; i++) {
            editButtons[i].addEventListener("click",editObjective);
        }
    }

    $(document).ready(function(){
        // Get competition id
        var competition_id = document.getElementById("competition-id").value;
        // Call to clickOnDelete function
        clickOnDelete();
        // Call to clickOnEdit function
        clickOnEdit();
        // Customised success msg
        if(localStorage.getItem("success")){
            $('#success-msg').css('display', 'block')
            localStorage.clear();
        }else if(localStorage.getItem("success-edit")){
            $('#success-msg-edit').css('display', 'block')
            localStorage.clear();
        }

        //------------------- Add new objective --------------------------------------------------------
        $('#add-objective-form').on('submit', function(e){
            e.preventDefault();
            $('#obj-error').html("");
            $('#objective').removeClass('is-invalid');
            $('#evaluator-error').html("");
            $('#evaluator').removeClass('is-invalid');
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
                        if(data.errors.evaluator){
                            $('#evaluator-error').html(data.errors.evaluator[0]);
                            $('#evaluator').addClass('is-invalid');
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
        //-----------------------------------------------------------------------------------------------

        //------------------------------------ Update objective -----------------------------------------
        $('#edit-objective-form').on('submit', function(e){
            e.preventDefault();
            $('#obj-new-error').html("");
            $('#obj-new').removeClass('is-invalid');
            $.ajax({
                type:'POST',
                url:'/competitions/'+competition_id+'/objectives/'+$('#hidden-obj-id').val(),
                data:$('#edit-objective-form').serialize(),
                dataType: 'json',
                success:function(data){
                    if(data.errors) {
                        //console.log(data.errors)
                        if(data.errors.new_objective){
                            $('#obj-new-error').html(data.errors.new_objective[0]);
                            $('#obj-new').addClass('is-invalid');
                        }
                    }
                    if(data.success) {
                        $('#editObjectiveModal').modal('hide');
                        localStorage.setItem("success-edit",data.OperationStatus)
                        window.location.reload();
                    }
                },
            })

        })
        //-----------------------------------------------------------------------------------------------
    })
</script>
@endsection