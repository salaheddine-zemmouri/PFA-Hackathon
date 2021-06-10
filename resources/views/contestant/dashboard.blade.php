@extends('layouts.contestant')
<!--ACTION SECTION -->
@section('actions')
<div class="col-md-4 offset-1">
    <a href="#" class="btn btn-warning btn-block shadow" data-toggle="modal" data-target="#joinClassModal">
        <i class="fas fa-plus"></i> Join Hackathon
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

@section('custom-modal')
    <!-- JOIN CLASS MODAL -->
    <div class="modal fade" id="joinClassModal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title">Join class</h5>
                    <button class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form method="POST" action="">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="class_code" class="mb-2">Enter class code to join</label>
                            <input type="text" class="form-control" id="class_code" name="code">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-warning" id="join" type="submit">Join</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ./JOIN CLASS MODAL -->

    <!-- EXIT CLASS MODAL -->
    <div class="modal fade" id="exitClassModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Attention</h5>
                    <button class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Do you really want to exit this class? This process cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-dark" data-dismiss="modal">Back</button>
                    <form id="exit_class_form" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Exit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- EXIT CLASS MODAL END -->
@endsection
