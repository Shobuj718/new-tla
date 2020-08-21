@if(Auth::check())
  <script>window.location = "/admin";</script>
@endif
<!DOCTYPE html>
<html>
    
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <style type="text/css" media="screen">
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
        }
        .user_card {
            height: auto;
            width: 350px;
            margin-top: auto;
            margin-bottom: auto;
            background: #f9f9f9;
            position: relative;
            display: flex;
            justify-content: center;
            flex-direction: column;
            padding: 130px 10px 80px;
            box-shadow: 0 5px 5px 0 rgba(0, 0, 0, 0.05), 0 0 20px -10px rgba(0, 0, 0, 0.05);
            -webkit-box-shadow: 0 5px 5px 0 rgba(0, 0, 0, 0.05), 0 0 20px -10px rgba(0, 0, 0, 0.05);
            -moz-box-shadow: 0 5px 5px 0 rgba(0, 0, 0, 0.05), 0 0 20px -10px rgba(0, 0, 0, 0.05);
            border-radius: 5px;

        }
        .brand_logo_container {
            position: absolute;
            height: 130px;
            width: 130px;
            top: -65px;
            border-radius: 50%;
            background: #ffffff;
            padding: 10px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #e1e1e1;
        }
        .brand_logo {
            height: auto;
            width: 75px;
            position: relative;
        }
        .user_card .form_container form {
            width: calc(100% - 50px);
        }
        .login_btn {
            width: calc(100% - 50px);
            background: #00CFCC;
            color: #ffffff;
        }
        .login_btn:focus {
            box-shadow: none !important;
            outline: 0px !important;
        }
        .login_container {
            padding: 0 2rem;
            margin-top: 50px;
        }
        .input-group-text {
            background: #00C3C0;
            color: white !important;
            border: 0 !important;
            border-radius: 0.25rem 0 0 0.25rem !important;
        }
        .form_container .form-control {
            font-size: 14px;
            border: 1px solid #e1e1e1;
        }
        .input_user,
        .input_pass:focus {
            box-shadow: none !important;
            outline: 0px !important;
        }
        .custom-checkbox .custom-control-input:checked~.custom-control-label::before {
            background-color: #c0392b !important;
        }
        .alert-danger {
            color: #721c24;
            font-size: 11px;
            padding: 10px;
        }
        .alert-danger strong {
            font-weight: 600;
        }
        .form_container .alert-dismissible .close {
            padding: 0 5px;
            font-size: 25px;
        }
    </style>
    
</head>
<!--Coded with love by Mutiullah Samim-->
<body>
    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="https://thelawapp.com.au/assets/img/logo-black.png" class="brand_logo" alt="Logo">
                    </div>
                </div>
                <div class="d-flex justify-content-center form_container">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible">
                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                              @foreach($errors->all() as $error)
                                <strong>{{  $error }}!</strong> <br> 
                              @endforeach
                            </div>
                        @endif
                        
                        <input type="radio" id="client" name="type" value="client">
                        <label for="male">Client</label><br>
                        <input type="radio" id="lawyer" name="type" value="lawyer">
                        <label for="female">Lawyer</label><br>
                        <input type="radio" id="admin" name="type" value="admin">
                        <label for="female">Admin</label><br>
  
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input id="email" type="email" class="form-control input_user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="username"   autocomplete="email" autofocus>
                        
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                             <input id="password" type="password" class="form-control input_pass @error('password') is-invalid @enderror" name="password" placeholder="password"  autocomplete="current-password">
                           
                        </div>
                        <div class="d-flex justify-content-center login_container">
                            <button type="submit" name="button" class="btn login_btn">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


