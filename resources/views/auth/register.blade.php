<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<style>
    body, html {
    height: 100%;
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
    }

    * {
    box-sizing: border-box;
    }
    hr{
        height: 2px;
        margin-top: 2px;
    }
    a{
        color:white;
        text-decoration:none;
    }
    .btn{
    border-radius: 20px;
    }
    a:hover{
        color: gray;
    }

    .bg-image {
    background-image: url("images/mart.jpg");
    filter: blur(8px);
    -webkit-filter: blur(5px);
    height: 100%; 
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    }
    .form-control {
        background: transparent;
        border: none;
        color: white;

    }
    .form-control::-webkit-input-placeholder {
    color: black;
    font-weight: bold;
    }
    /* Position text in the middle of the page/image */
    .bg-text {
    background-color: rgba(255, 255, 255, 0.7); /* Black w/opacity/see-through */
    color: rgb(0, 0, 0);
    font-weight: bold;
    /* border: 3px solid #f1f1f1; */
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 2;
    width: 50%;
    padding: 20px;
    text-align: center;
    border-radius: 20px;
    }
</style>
</head>
<body>
<div class="bg-image"></div>
<div class="bg-text">
      <!-- _______ -->
    <div id="register">
      <br>
      {{-- <h1 class="text-center">My Library</h1> --}}
      <br>
      <form method="POST" action="{{ route('register') }}">
        @csrf
          <div class="row">
              <div class="col-sm-12">
                <div class="row">
                  <div class="col-sm-5" style="text-align: right;">
                    @if (Route::has('login'))
                    <a class="btn show_login" id="show_login" style="color: black;font-size: 25px;" href="{{ route('login') }}">Signin</a>
                    @endif
                  </div>
                  <div class="col-sm-2">
                  </div>
                  <div class="col-sm-5" style="text-align: left;">
                    @if (Route::has('register'))
                    <a class="btn"  style="color: black;font-size: 25px;" href="{{ route('register') }}">Register</a>
                    @endif
                  </div>
                </div>
                </div>
                <br>
                <br>
          <div>
            <div class="col-sm-12">
              <div class="row">
                <div class="col-sm-1">
                </div>
                <div class="col-sm-10">
                <input id="name" type="text" placeholder="Username" style="text-align: center;" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                  @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                <hr>

                </div>
                <div class="col-sm-1">
                </div>
              </div>
            </div>
            
              <div class="col-sm-12" style="margin-top: 10px;">
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                  <div class="col-sm-10">
                  <input id="email" type="email"  placeholder="Email" style="text-align: center;"  class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                  <hr>

                  </div>
                  <div class="col-sm-1">
                  </div>
                </div>
              </div>
         
              <div class="col-sm-12" style="margin-top: 10px;">
                <div class="row">
                  <div class="col-sm-1">
                  </div>
                  <div class="col-sm-10">
                  <input type="phone" class="form-control" id="phone" name="phone" aria-describedby="phoneHelp" placeholder="Phone Number" style="text-align: center;">
                  <hr>

                  </div>
                  <div class="col-sm-1">
                  </div>
                </div>
              </div>
                <div class="col-sm-12" style="margin-top: 10px;">
                  <div class="row">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-4" style="text-align: right;">
                      <input id="password" placeholder="Password" style="text-align: center;" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                      @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                      <hr>

                    </div>
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-4" style="text-align: right;">
                      <input id="password-confirm"  placeholder="Password Comfirm" style="text-align: center;" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                      <hr>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary">
                  {{ __('Register') }}
              </button>
          </div>
      </form>
</div>
</body>
</html>
