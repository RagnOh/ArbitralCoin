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
            <div class="container-fluid">
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <ul class="logo">
                <a class="navbar-brand" href="{{ route('home')}}">@yield('titolo')</a>
                </ul>
                <ul class="nav navbar-nav navbar-right">
              @yield('navBarElements')
              </ul>
            </div>
</div>
        </nav>

        <div class="container">
        @yield('contenuto')
    </div>
   </body>


</html>