@extends('layouts.dashboard-layout')

@section('actions')
<div class="col-md-4 offset-1 d-grid gap-2">
    <a href="#" class="btn btn-success shadow" data-bs-toggle="modal" data-bs-target="#createCompModal">
        <i class="fas fa-plus"></i> Create Competition
    </a>
</div>
<div class="col-md-4 offset-2">
    <input type="text" name="search" id="search" class="form-control shadow" placeholder="Search">
</div>
@endsection

@section('customised-msg')
<div class="alert alert-success alert-dismissible fade show" role="alert" id="success-msg" style="display: none;">
    <strong>Competition created successfully</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endsection

@section('content')
@foreach ($competitions as $competition)
<div class="col-lg-4 col-sm-6 mb-4">
    <div class="card h-80 shadow-sm">
        <div class="card-body">
            <h4 class="card-title">{{$competition->name}}</h4>
            <p class="card-text">From : {{$competition->start_date}}</p>
            <p class="card-text">To : {{$competition->end_date}}</p>
            <a href="#" class="btn btn-primary">Go</a>
        </div>
    </div>
</div>
@endforeach
@endsection

@section('pagination')
    
@endsection

@section('customised-modal')
<div class="modal fade" id="createCompModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Competition</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="create_competition_form" method="POST" action="{{ route('competitions.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="comp_name">Name</label>
                        <input type="text" name="name" class="form-control" id="comp_name" value="{{ old('name') }}">
                        <span class="invalid-feedback">
                            <strong id="name_error"></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Start date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}">
                        <span class="invalid-feedback">
                            <strong id="start_date_error"></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="end_date">End date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}">
                        <span class="invalid-feedback">
                            <strong id="end_date_error"></strong>
                        </span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button name="create" class="btn btn-success" id="create" type="submit">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('customised-js')
<script type="text/javascript">
    /*function archiveClass() {
        var tr = this.parentElement.parentElement;
        var id = tr.children[0].children[0].value;
        //document.getElementById("archive_class_form").action = "/myclasses/"+id;
    }*/
    $(document).ready(function(){
        if(localStorage.getItem("success")){
            $('#success-msg').css('display', 'block')
            localStorage.clear();
        }

        $('#create_competition_form').on('submit', function(e){
            e.preventDefault();
            $('#name_error').html("");
            $('#comp_name').removeClass('is-invalid');
            $('#start_date_error').html("");
            $('#start_date').removeClass('is-invalid');
            $('#end_date_error').html("");
            $('#end_date').removeClass('is-invalid');
            $.ajax({
                type:'POST',
                url:'/competitions',
                data:$('#create_competition_form').serialize(),
                dataType: 'json',
                success:function(data){
                    if(data.errors) {
                        if(data.errors.name){
                            $('#name_error').html(data.errors.name[0]);
                            $('#comp_name').addClass('is-invalid');
                        }
                        if(data.errors.start_date){
                            $('#start_date_error').html(data.errors.start_date[0]);
                            $('#start_date').addClass('is-invalid');
                        }
                        if(data.errors.end_date){
                            $('#end_date_error').html(data.errors.end_date[0]);
                            $('#end_date').addClass('is-invalid');
                        }
                    }
                    if(data.success) {
                        $('#createCompModal').modal('hide');
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

</body>
</html>