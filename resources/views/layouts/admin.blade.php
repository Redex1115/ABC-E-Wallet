<!Doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <!-- Styles -->
        <link rel="canonical" href="https://www.wrappixel.com/templates/elegant-admin-lite/" />
        <link href="../assets/node_modules/morrisjs/morris.css" rel="stylesheet">
        <link href="../assets/node_modules/c3-master/c3.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet" type='text/css'>
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/breadcrumb.css') }}" rel="stylesheet">
        <link href="{{ asset('css/dashboard1.css') }}" rel="stylesheet">
        
        @if(!Session::has('adminData'))
            <script type="text/javascript">
                window.location.href="{{url('admin/login')}}"
            </script>
        @endif
    </head> 
    <body class="skin-default-dark fixed-layout">

        @include('functionPage.preloader')

        @include('functionPage.topbar')
        
        @include('functionPage.sidebar')

        <div class="page-wrapper" style="min-height: 598px;">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>

        <script src="../assets/node_modules/popper/popper.min.js"></script>
        <script src="../assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="{{ asset('js/perfect-scrollbar.jquery.min.js') }}"></script>
        <script src="../assets/node_modules/raphael/raphael-min.js"></script>
        <script src="../assets/node_modules/morrisjs/morris.min.js"></script>
        <script src="../assets/node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
        <script src="../assets/node_modules/d3/d3.min.js"></script>
        <script src="../assets/node_modules/c3-master/c3.min.js"></script>
        <script src="{{ asset('js/dashboard1.js') }}"></script>
        <script src="{{ asset('js/waves.js') }}"></script>
        <script src="{{ asset('js/sidebarmenu.js') }}"></script>
        <script src="{{ asset('js/custom.min.js') }}"></script>
    </body>
</html>
