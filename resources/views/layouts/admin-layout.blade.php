<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @yield('title')

    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <!-- Fontawesome CSS link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href= {{asset('css/mycss.css')}} rel="stylesheet">

</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark p-0 fixed-top shadow">
        <div class="container">
            <span class="navbar-brand">Hackathon</span>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <ul class="navbar-nav">                   
                    <li class="nav-item px-2" id="competition-teams">
                        <a href="{{ route('competitions.teams.index',$competition->id) }}" class="nav-link @if ($active == 'teams') active @endif">Teams</a>
                    </li>                  
                    <li class="nav-item px-2" id="competition-evaluators">
                        <a href="{{ route('competitions.evaluators.index',$competition->id) }}" class="nav-link @if ($active == 'evaluators') active @endif">Evaluators</a>
                    </li>
                    <li class="nav-item px-2" id="competition-objectives">
                        <a href="{{ route('competitions.objectives.index',$competition->id) }}" class="nav-link @if ($active == 'objectives') active @endif">Objectives</a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto d-flex">
                    <li class="nav-item dropdown mr-3">
                        <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">
                            <i class="fas fa-user"></i> Welcome {{$admin->name}}
                        </a>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-user-circle"></i> Profile Settings
                            </a>
                            <a href={{route('logout')}} class="dropdown-item">
                                <i class="fas fa-user-times "></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- ./NAVBAR -->

    <!-- PAGE CONTENT -->
    <div class="page-content">
        <!-- ACTIONS -->
        <section id="actions" class="py-4 mb-4 bg-light shadow-sm">
            <div class="container">
                <div class="row">
                    @yield('actions')
                </div>
            </div>
        </section>
        <!-- ./ACTIONS -->

        <!-- MAIN CONTENT -->
        <section id="posts">
            <div class="container">
                <div class="row justify-content-center">
                    <!-- CUSTOM CONTENT -->
                    @yield('content')
                    <!-- ./CUSTOM CONTENT -->

                    <!-- BOXES -->
                    <div class="col-md-3">
                        <div class="card text-center bg-success text-white mb-3 shadow">
                            <div class="card-body ">
                                <h1>{{$competition->name}}</h1>
                                {{-- <h4 class="display-4 ">
                                    <i class="fas fa-users"></i>
                                </h4>
                                <a href="#" class="btn btn-outline-light btn-sm ">View</a> --}}
                            </div>
                        </div>

                        <div class="card text-center bg-primary text-white mb-3 shadow">
                            <div class="card-body ">
                                <h3>Access code:</h3>
                                <h4>{{$competition->code}}</h4>
                                {{-- <h4 class="display-4 ">
                                    <i class="fas fa-user-check"></i>
                                </h4>
                                <a href="#" class="btn btn-outline-light btn-sm ">View</a> --}}
                            </div>
                        </div>

                        {{-- <div class="card text-center bg-warning text-white mb-3 shadow">
                            <div class="card-body ">
                                <h3>Objectives</h3>
                                <h4 class="display-4 ">
                                    <i class="fas fa-check"></i>
                                </h4>
                                <a href="#" class="btn btn-outline-light btn-sm ">View</a>
                            </div>
                        </div>
                    </div> --}}
                    <!-- ./BOXES -->
                </div>
            </div>
        </section>
        <!-- ./MAIN CONTENT -->
    </div>
    <!-- ./PAGE CONTENT -->

    {{-- <!-- COPYRIGHT FOOTER -->
    <footer id="sticky-footer" class="py-4 bg-dark text-white-50">
        <div class="container text-center">
            <small>Copyright &copy; Hackathon 2021 - <script type="text/JavaScript"> document.write(new Date().getFullYear()) </script></small>
        </div>
    </footer>
    <!-- ./COPYRIGHT FOOTER --> --}}


    <!----------------------------------------- MODALS ------------------------------------------>

    <!-- CUSTOMISED MODAL -->
    @yield('customised-modal')
    <!-- ./CUSTOMISED MODAL -->


    <!-- Jquery link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>     --}}
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <!-- Customised JS link -->
    @yield('customised-js')

</body>

</html>