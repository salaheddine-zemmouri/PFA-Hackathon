@extends('layouts.admin-layout')

@section('title')
<title>Hackathon - Evaluators</title>
@endsection

@section('actions')
<div class="col-md-4 offset-1 d-grid gap-2">
    <a href="#" class="btn btn-success shadow" data-bs-toggle="modal" data-bs-target="#addEvaluatorModal">
        <i class="fas fa-plus"></i> Add Evaluator
    </a>
</div>
<div class="col-md-4 offset-2">
    <input type="text" name="search" id="search" class="form-control shadow" placeholder="Search">
</div>
@endsection

@section('content')
<div class="col-md-9">
    {{-- Get competition id --}}
    <input type="hidden" name="competition-id" id="competition-id" value="{{$competition->id}}">

    {{-- Success msg on add --}}
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-msg" style="display: none;">
        <strong>Record added successfully</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    {{-- Success msg on delete --}}
    {{-- @if (session()->has('objective_deleted'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('objective_deleted') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif --}}

    {{-- Evaluators Datatable --}}
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Evaluators</h4>
        </div>
        <table class="table table-hover" id="datatable">
            <thead class="thead-light table-secondary">
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($evaluators as $evaluator)
                <tr>
                    <td>
                        <input type="hidden" id="evaluator-id" name="evaluator-id" value="{{$evaluator->id}}">
                    </td>
                    <td>{{$evaluator->name}}</td>
                    <td>{{$evaluator->email}}</td>
                    <td>
                        <a href="#" class="btn btn-light delete-eval" data-bs-toggle="modal" data-bs-target="#deleteEvaluatorModal">
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
            {{ $evaluators->links() }}
        </div>
    </div>
</div>
@endsection

@section('customised-modal')
<div class="modal fade" id="addEvaluatorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Evaluator</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="add-evaluator-form" method="POST" action="">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
                        <span class="invalid-feedback">
                            <strong id="evaluator-name-error"></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}">
                        <span class="invalid-feedback">
                            <strong id="evaluator-email-error"></strong>
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

<div class="modal fade" id="deleteEvaluatorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Evaluator</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Do you really want to delete this record? This process cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-dark" data-bs-dismiss="modal">Back</button>
                <form id="delete-evaluator-form" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button name="delete" class="btn btn-danger" id="delete" type="submit">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('customised-js')
<script type="text/javascript">

    function deleteEvaluator() {
        var competition_id = document.getElementById("competition-id").value;
        var tr = this.parentElement.parentElement;
        var evaluator_id = tr.children[0].children[0].value;

        //Setting up the action for the delete form 
        document.getElementById("delete-evaluator-form").action = "/competitions/"+competition_id+"/evaluators/"+evaluator_id;
    }

    function clickOnDelete(){
        var deleteButtons = document.getElementsByClassName("delete-eval");
        for (let i = 0; i < deleteButtons.length; i++) {
            deleteButtons[i].addEventListener("click",deleteEvaluator);
        }
    }

    $(document).ready(function(){
        // Get competition id
        var competition_id = document.getElementById("competition-id").value;
        // Call to clickOnDelete function
        clickOnDelete();
        // Customised success msg
        if(localStorage.getItem("success")){
            $('#success-msg').css('display', 'block');
            localStorage.clear();
        }

        //------------------- Add new evaluator --------------------------------------------------------
        $('#add-evaluator-form').on('submit', function(e){
            e.preventDefault();
            $('#evaluator-name-error').html("");
            $('#name').removeClass('is-invalid');
            $('#evaluator-email-error').html("");
            $('#email').removeClass('is-invalid');
            $.ajax({
                type:'POST',
                url:'/competitions/'+competition_id+'/evaluators',
                data:$('#add-evaluator-form').serialize(),
                dataType: 'json',
                success:function(data){
                    if(data.errors) {
                        if(data.errors.name){
                            $('#evaluator-name-error').html(data.errors.name[0]);
                            $('#name').addClass('is-invalid');
                        }
                        if(data.errors.email){
                            $('#evaluator-email-error').html(data.errors.email[0]);
                            $('#email').addClass('is-invalid');
                        }
                    }
                    if(data.success) {
                        $('#addEvaluatorModal').modal('hide');
                        localStorage.setItem("success",data.OperationStatus);
                        window.location.reload();
                    }
                },
            })
        })
        //-----------------------------------------------------------------------------------------------
    })
</script>
@endsection