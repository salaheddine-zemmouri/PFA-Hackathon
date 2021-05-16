<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hackathon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link href= {{secure_asset('css/app.css')}} rel="stylesheet">
</head>
  <body>
    <div class="container-fluid row h-full">

      <div class="col-6 d-flex justify-content-center align-items-center">
        <img src={{secure_asset('images/login_img.svg')}} class="img-fluid w-75">
      </div>

      <div class="col-6 d-flex justify-content-center align-items-center">
        <div class="form-container w-75">
          <div class="m-5 row justify-content-center ">

              <h3 class="text-center color-primary mb-4">Sign In</h3>
              <h6 class="text-center color-secondary fw-light mb-4">Who are you ?</h6>
              <form action="{{route('login')}}" method="POST" class="mb-4">
                  @csrf
                  <div class="radio-buttons d-flex justify-content-center mb-4">
                    <label class="custom-radio">
                      <input type="radio" name="radio" value="contestant" />
                        <span class="radio-btn">
                          <div class="user-icon">
                            <img src={{secure_asset('images/contestant.svg')}} class="w-100">
                          </div>
                        </span>
                       <div class="text-center text-black">Contestant</div>
                    </label>

                    <label class="custom-radio">
                      <input type="radio" name="radio" value="evaluator" />
                        <span class="radio-btn">

                          <div class="user-icon">
                            <img src={{secure_asset('images/evaluator.svg')}} class="w-100">
                          </div>
                        </span>
                      <div class="text-center text-black">Evaluator</div>
                    </label>

                    <label class="custom-radio">
                      <input type="radio" name="radio" value="administrator" />
                        <span class="radio-btn">

                          <div class="user-icon">
                            <img src={{secure_asset('images/admin.svg')}} class="w-100">
                          </div>
                        </span>
                      <div class="text-center text-black">Administrator</div>
                    </label>
                  </div>

                  <div class="mb-4">
                      <label for="email" >Email</label>
                      <input type="email" name="email" id="email" class="w-100 d-block p-1 border border-primary @error('email') is-invalid border-danger @enderror">
                      @error('email')
                          <div class="invalid-feedback">
                              {{$message}}
                          </div>
                      @enderror
                  </div>

                  <div class="mb-4">
                      <label for="password">Password</label>
                      <input type="password" name="password" id="password" class="w-100 d-block  p-1 border border-primary @error('password') is-invalid border-danger @enderror">
                      @error('password')
                          <div class="invalid-feedback">
                              {{$message}}
                          </div>
                      @enderror
                  </div>
                  <button type="submit" class="btn btn-primary ps-5 pe-5 btn-circle ">Login</button>
              </form>

              <div class="mb-4 d-flex align-items-center or-container m-1">
                  <div class="col-5 line-separator"></div>
                  <div class="col text-center"> or </div>
                  <div class="col-5 line-separator"></div>
              </div>

              <div class="mb-4 btn btn-outline-primary p-2">
                <img src={{secure_asset('images/google-logo.svg')}} class="google-logo">
                <span>Sign-in Using Google</span>
              </div>



          </div>
      </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
  </body>
</html>
