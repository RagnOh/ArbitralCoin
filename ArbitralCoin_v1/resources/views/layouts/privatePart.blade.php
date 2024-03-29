<!DOCTYPE html>
<html>
   <head>
    
     <meta charset="utf-8">
     <title> @yield('titolo')</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0, 
              user-scalable=no">

     <!-- Fogli di stile -->
     <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.min.css">
     <link rel="stylesheet" href="{{ url('/') }}/css/style.css">
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
    
    <div class="logo-box container justify-content-md-end  col-lg-1 col-md-10 col-sm-10 col-10">
                <a class="navbar-brand centered" id="logo" href="{{ route('home') }}">@yield('titolo')</a>
                </div>
    <div class="col-lg-2 col-md-1 col-sm-2 col-2 c-button">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand col-lg-3 me-0" href="#">&nbsp;</a>
</div>
                <div class=" collapse navbar-collapse  col-lg-7 col-md-5 col-sm-5 col-2 " id="navbarResponsive">
         <ul class="nav  navbar-nav col-lg-9">
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
            <div class=" collapse navbar-collapse col-lg-3 col-md-3 col-sm-4 col-4" id="navbarResponsive">
         <ul class="nav navbar-nav navbar-right">
                    @if($logged)
                       <li class="nav-item"><i>Benvenuto {{ $loggedName }}</i> <a class="btn btn-outline-dark" href="{{ route('user.logout')}}"> Logout</a>  </li>
                    @else
                       <li class="nav-item"><a class="btn btn-outline-dark" href="{{ route('user.login')}}"> Logint</a></li>

                    @endif
                </ul>  
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