<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signin</title>
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
    width: 35%;
    padding: 20px;
    text-align: center;
    border-radius: 20px;
    }
</style>
</head>

<body>
<div class="bg-image"></div>
<div class="bg-text">
    <div  id="login">
        <br>
        <h2 class="text-center">Login</h2>
        @include('layouts.component.alert-dismissible')

        <form class="user" method="POST" action="{{ route('login') }}">

            @csrf
            <div class="row">
                  {{-- <div class="col-sm-12">
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
                  </div> --}}
                  <br>
                <div>
                <div class="col-sm-12">
                  <div class="row">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-8">
                    <input id="email" type="email" style="text-align: center;" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    <hr>
                    </div>
                    <div class="col-sm-2">
                    </div>
                  </div>
                </div>
                <div class="col-sm-12" style="margin-top: 10px;">
                    <div class="row">
                      <div class="col-sm-2">
                      </div>
                      <div class="col-sm-8">
                        <input id="password" type="password" style="text-align: center;" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      <hr>
                      </div>
                      <div class="col-sm-2">
                      </div>
                    </div>
                  </div>
                </div>

            </div>
            <button type="submit" class="btn btn-primary">
                {{ __('Login') }}
            </button>
        </form>
    </div>
</div>
</body>
</html>
