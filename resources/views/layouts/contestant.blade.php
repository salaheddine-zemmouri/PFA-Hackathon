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
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark p-0 fixed-top">
        <div class="container">
            <span class="navbar-brand">Hackathon</span>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
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
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-user"></i> Welcome {{ $contestant->name }}
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

    <!-- PAGE CONTENT -->
    <div class="content">
        <section id="actions" class="py-4 mb-4 bg-light shadow-sm">
            <div class="container">
                <div class="row">
                    @yield('actions')
                </div>
            </div>
        </section>
        <div class="container" id="taught">
            <div class="row d-flex justify-content-center">
                @yield('custom-msg')
            </div>
            <div class="row justify-content-center">
                @yield('content')
            </div>
            <!-- /.row -->
    
            <!-- Pagination -->
            @yield('pagination')
        </div>
    </div>
    
    <!-- /.container -->

    <!-- Copyrights footter -->
    <footer id="sticky-footer" class="py-4 bg-dark text-white-50 fixed-bottom">
        <div class="container text-center">
            <small>Copyright &copy; Hackathon 2020 - 2021</small>
        </div>
    </footer>
    <!-- End copyrights footer -->

    <!-- MODALS -->
    @yield('custom-modal')
    <!-- MODALS END -->

    <!-- Jquery link -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>    
    <!-- Popper link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <!-- Bootstrap JS link -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Custom JS link -->
    @yield('custom-js')

</body>

</html>