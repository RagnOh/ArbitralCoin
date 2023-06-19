<!DOCTYPE html>
<html>
   <head>
    
     <meta charset="utf-8">
     <title> @yield('title')</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0, 
              user-scalable=no">

     <!-- Fogli di stile -->
     <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.min.css">
     <link rel="stylesheet" href="{{ url('/') }}/css/@yield('stile')">
     <link rel="stylesheet" href="{{ url('/') }}/css/frontPage.css">
     <link rel="stylesheet" href="{{ url('/') }}/css/style2.css">
     
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"> <!--icone -->

     <!-- jQuery e plugin JavaScript  -->
     <script src="http://code.jquery.com/jquery.js"></script>
     <script src="{{ url('/') }}/js/bootstrap.bundle.min.js"></script>

   </head>
   <body id="page-top">
    <div class="container fluid">
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
            <div class="container-fluid">
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <ul class="logo">
                <a class="navbar-brand" href="#page-top">@yield('titolo')</a>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                <div class="collapse navbar-collapse" id="navbarResponsive">
                @if($logged)
                       <li><i>Welcome {{ $loggedName }}</i> <a class="btn btn-outline-light" href="{{ route('privateSection.index')}}"> Il mio Account</a>  </li>
                    @else
                       <li><a class="btn btn-outline-light " href="{{ route('user.login')}}"> Accedi</a></li>
                       <li class="btn-crea"><a class="btn btn-outline-light " href="{{ route('user.login')}}" > Registrati</a></li>
                    @endif
                </div>
</ul>
            </div>
</div>
        </nav>
   
      <div class="main-container">
        
       @yield('contenuto')
      </div>

    </body>


</html>