<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>User authentication</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <!-- Fogli di stile -->
        <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ url('/') }}/css/style.css">
        <link rel="stylesheet" href="{{ url('/') }}/css/auth.css">
        <!-- Icone Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <!-- jQuery e plugin JavaScript -->
        <script src="https://code.jquery.com/jquery.js"></script>
        <script src="{{ url('/') }}/js/bootstrap.bundle.min.js"></script>
        @yield('scripts')
    </head>

    <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
            <div class="container-fluid text-centered row">
                
            <div class="container justify-content-md-end col col-lg-9 col-md-6 col-sm-6 col-5">
                <a class="navbar-brand centered" id="logo" href="{{ route('home') }}">@yield('titolo')</a>
                </div>

                <div class="  col-lg-3 col-md-4 col-sm-4 col-7" id="navbarResponsive">
                @yield('navBarElements')
                </div>
                
            </div>
</div>
        </nav>

        <div class="container">
        @yield('contenuto')
    </div>
   </body>


</html>