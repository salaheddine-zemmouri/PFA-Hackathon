<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hackathon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link href= {{asset('css/app.css')}} rel="stylesheet">
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand navbar-light mt-2">
          <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item me-5">
                  <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item me-5">
                  <a class="nav-link" href="#">Contact</a>
                </li>
                <li class="nav-item me-5">
                  <a class="nav-link" href="#">About</a>
                </li>
              </ul>
              @guest('administrator')
                  <a  href={{route('login')}} class="btn btn-primary my-btn" type="submit" >Login</a>
              @endguest

              @auth('administrator')
                  <a  href="" class="btn btn-primary my-btn" type="submit" >Logout</a>
              @endauth

            </div>
          </div>
        </nav>
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
</body>
</html>
