<!Doctype html>
<html>
    <head>
        <title>Admin Login</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!-- Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet" type='text/css'>
       
       <style>
            body{
                background-image:linear-gradient(to bottom, #ff914d, #ff9b4f,#ffd858);
            }

            .btn-color{
                background-color: #0e1c36;
                color: #fff;
                border-radius:1.4rem;
            }
            .btn-color:hover{
                background-color:#000;
                color:#fff;
            }
            .profile-image-pic{
                height: 200px;
                width: 200px;
                object-fit: cover;
            }
            .cardbody-color{
                background-color: #ebf2fa;
            }
            a{
                text-decoration: none;
            }
            
            .rememberme{
                display: flex;
                align-items: center;
                padding-bottom: 5px;
                margin-top: -5px;
            }
            .rememberme span{
                padding-left: 5px;
                padding-right: 5px;
            }
</style>
    </head>
    <body>        
    @include('functionPage.toastr')
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <br><br>
                    <h2 class="text-center mb-3 text-dark">Welcome back Admin!</h2>
                    <div class="card my-5">
                    <form class="card-body cardbody-color p-lg-4" method="POST" action="{{ url('admin/login')}}">
                        @csrf
                        <div class="text-center">
                            <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px" alt="profile">
                        </div>

                        <div class="mb-3">
                            <input type="text" class="form-control" name="loginID" id="loginID" aria-describedby="emailHelp" placeholder="User Name"  @if(Cookie::has('loginID')) value="{{Cookie::get('loginID')}}" @endif>
                        </div>

                        <div class="mb-3">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password"  @if(Cookie::has('password')) value="{{Cookie::get('password')}}" @endif>
                        </div>

                        <div class="rememberme">
                            <input type="checkbox" name="rememberme" id="rememberme" @if(Cookie::has('loginID')) checked @endif><span>Remember Me</span>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-color px-5 mb-5 w-100">Login</button>
                        </div>

                    </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>