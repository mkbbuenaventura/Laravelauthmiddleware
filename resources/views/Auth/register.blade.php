<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>REGISTER</title>

        <!-- Fonts -->
        <!-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"> -->
        <!-- CSS only -->
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
        <!-- Bootstrap only -->
        
  
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Styles -->
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row" style="margin-top: 45px;">
                <div class="col-md-4 col-md-offset-4">
                    <h4>Register | Custom Auth</h4><hr>
                    <form action="/auth/save" method="post">


                        @if(Session::get('success'))
                        <div class="alert alert-success">
                            <span class="alert alert-success"> {{ Session::get('success') }} </span>
                        </div>
                        @endif

                        @if(Session::get('fail'))
                        <div class="alert alert-danger">
                            {{ Session::get('fail') }}
                        </div>
                        @endif


                        @csrf()
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter your name" value="{{ old('name') }}">
                            <span class="text-danger"> @error('name'){{ $message }} @enderror</span> 
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" placeholder="Enter your email address" value="{{ old('email') }}">
                            <span class="text-danger"> @error('email'){{ $message }} @enderror</span>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter password">
                            <span class="text-danger"> @error('password'){{ $message }} @enderror</span>
                        </div>
                        <button type="submit" class="btn btn-block btn-primary">Sign up</button>
                        <br>
                        <a href="/auth/login">I already have an Account, sign in</a>
                    </form>
                </div> 
            </div>
        </div>
    </body>
</html>
