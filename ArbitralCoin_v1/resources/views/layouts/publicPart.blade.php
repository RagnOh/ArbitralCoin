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
    <div class="container fluid t">
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
            <div class="container-fluid text-centered row">
                
               
                
                <div class=" logoBar container justify-content-md-end col col-lg-9 col-md-3 col-sm-3 col-3">
                <a class="navbar-brand centered" id="logo" href="#page-top">@yield('titolo')</a>
                </div>
                
               
                
   
                <div class=" buttons  col-lg-3 col-md-5 col-sm-6 col-5" id="navbarResponsive">
                @if($logged)
                       <i>Welcome {{ $loggedName }}</i> <a class="btn btn-outline-light" href="{{ route('privateSection.index')}}"> Il mio Account</a>  
                       
                    @else
                       <a class="btn btn-outline-light " href="{{ route('user.login')}}"> Accedi</a>
                       <a class="btn btn-outline-light " href="{{ route('user.registration')}}" > Registrati</a>
                    @endif
                </div>
</ul>
            </div>
</div>
        </nav>
   
      
        
       @yield('contenuto')
     

    </body>


</html>