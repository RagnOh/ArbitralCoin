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

     <!-- jQuery e plugin JavaScript  -->
     <script src="http://code.jquery.com/jquery.js"></script>
     <script src="{ url('/') }}/js/bootstrap.bundle.min.js"></script>

   </head>
    <body>
    <nav class="navbar bg-body-tertiary">
    <div class="container-fluid">
         <b class="navbar-brand" >
           <!--<img src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">-->
           @yield('titolo')
         </b>
         <ul class="navbar-nav col-lg-6">
         <li class="nav-item">
    <a class="nav-link" aria-current="page" href="{{ route('userPreferences.index') }}">Settings</a>
    <a class="nav-link" aria-current="page" href="{{ route('privateSection.index') }}">Pairs Table</a>
</li>
<li class="nav-item">
    <a class="nav-link"  href="{{ route('bestPairs.index') }}">bestPairs</a>
</li>
<li class="nav-item">
    <a class="nav-link" aria-current="page" href="{{ route('favPairs.index') }}">favoritePairs</a>
</li>
                </ul>
         <ul class="nav navbar-nav navbar-right">
                    @if($logged)
                       <li><i>Welcome {{ $loggedName }}</i> <a class="btn btn-outline-dark" href="{{ route('user.logout')}}"> Logout</a>  </li>
                    @else
                       <li><a class="btn btn-outline-dark" href="{{ route('user.login')}}"> Logint</a></li>

                    @endif
                </ul>    
    </div>
</nav>

      <div class="container">
        @yield('contenuto')
    </div>
   </body>


</html>