<!DOCTYPE html>
<html>
   <head>
    
     <meta charset="utf-8">
     <title> @yield('titolo')</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0, 
              user-scalable=no">

     <!-- Fogli di stile -->
     <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.min.css">
     <link rel="stylesheet" href="{{ url('/') }}/css/@yield('stile')">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"> <!--icone -->
     
     @yield('cssResource')
     <!-- jQuery e plugin JavaScript  -->
     <script src="http://code.jquery.com/jquery.js"></script>
     <script src="{{ url('/') }}/js/bootstrap.bundle.min.js"></script>
    
     @yield('pageScript')

   </head>
    <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      
    <div class="container-fluid text-centered row">
    
    <div class="container justify-content-md-end col col-lg-2 col-md-3 col-sm-3 col-2">
                <a class="navbar-brand centered" id="logo" href="{{ route('home') }}">@yield('titolo')</a>
                </div>

                <div class=" collapse navbar-collapse col-lg-8 col-md-6 col-sm-6 col-8" id="navbarResponsive">
         <ul class="nav navbar-right navbar-nav col-lg-6">
         <li class="nav-item">
    <a class="nav-link" aria-current="page" href="{{ route('preferenceSettings.index') }}">Settings</a>
    
</li>
<li class="nav-item">
<a class="nav-link" aria-current="page" href="{{ route('adminUserList.index') }}">Admin</a>
</li>
<li class="nav-item">
<a class="nav-link" aria-current="page" href="{{ route('privateSection.index') }}">PairsTable</a>
</li>
<li class="nav-item">
    <a class="nav-link"  href="{{ route('bestPairs.index') }}">BestPairs</a>
</li>
<li class="nav-item">
    <a class="nav-link" aria-current="page" href="{{ route('favPairs.index') }}">FavoritePairs</a>
</li>
                </ul>
            </div>    
            <div class="  col-lg-2 col-md-2 col-sm-3 col-2" id="navbarResponsive">
         <ul class="nav navbar-nav navbar-right">
                    @if($logged)
                       <li><i>Welcome {{ $loggedName }}</i> <a class="btn btn-outline-dark" href="{{ route('user.logout')}}"> Logout</a>  </li>
                    @else
                       <li><a class="btn btn-outline-dark" href="{{ route('user.login')}}"> Logint</a></li>

                    @endif
                </ul>  
</div>  
    </div>
    </div>
</nav>

<div class="container">
        @yield('breadcrumb')
    </div>
      <div class="container">
        @yield('contenuto')
    </div>
   </body>


</html>