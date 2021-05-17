<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hackathon - Competitions</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <!-- Fontawesome CSS link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">

    <link href= {{asset('css/mycss.css')}} rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark p-0 fixed-top">
        <div class="container">
            <span class="navbar-brand">Hackathon</span>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav">                   
                    <li class="nav-item px-2" id="myCompetitions">
                        <a href="#" class="nav-link active">My Competitions</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto d-flex">
                    <li class="nav-item dropdown mr-3">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fas fa-user"></i> Welcome {{$admin->name}}
                        </a>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-user-circle"></i> Profile Settings
                            </a>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-user-times "></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- ./Navbar -->

    <!-- Page Content -->
    <div class="content">
        <section id="actions" class="py-4 mb-4 bg-light shadow-sm">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 offset-1 d-grid gap-2">
                        <a href="#" class="btn btn-success shadow" data-bs-toggle="modal" data-bs-target="#createCompModal">
                            <i class="fas fa-plus"></i> Create Competition
                        </a>
                    </div>
                    <div class="col-md-4 offset-2">
                        <input type="text" name="search" id="search" class="form-control shadow" placeholder="Search">
                    </div>
                </div>
            </div>
        </section>
        <div class="container" id="competitions">
            {{-- Alert for class created --}}
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-msg" style="display: none;">
                <strong>Class created successfully</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{-- <div class="row d-flex justify-content-center" id="msg">
                <div class="alert alert-primary" role="alert">
                    This is a primary alert—check it out!
                </div>
            </div> --}}
            <div class="row" id="mycompetitions">
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
            </div>
            <!-- /.row -->
      
            <!-- Pagination -->
            
            <!-- ./Pagination -->
        </div>
    </div>
    <!-- ./Page Content -->

    <!-- MODALS -->

    <!-- CREATE COMPETITION MODAL -->

    <!-- Modal -->
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
    <!-- CREATE CLASS MODAL END -->

    <!-- Jquery link -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>    
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script type="text/javascript">
        function archiveClass() {
            var tr = this.parentElement.parentElement;
            var id = tr.children[0].children[0].value;
            //document.getElementById("archive_class_form").action = "/myclasses/"+id;
        }
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
                    url:'/admin/competitions',
                    data:$('#create_competition_form').serialize(),
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
</body>
</html>