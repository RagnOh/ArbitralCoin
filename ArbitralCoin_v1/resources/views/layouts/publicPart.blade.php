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
     
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"> <!--icone -->

     <!-- jQuery e plugin JavaScript  -->
     <script src="http://code.jquery.com/jquery.js"></script>
     <script src="{ url('/') }}/js/bootstrap.bundle.min.js"></script>

   </head>
   <body>
     <nav class="navbar bg-body-tertiary">
       <div class="container-fluid">
         <a class="navbar-brand" >
           <!--<img src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">-->
           @yield('titolo')
         </a>
       
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">My Library</a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">Books's list</a></li>
        <li><a class="dropdown-item" href="#">Authors' list</a></li>
    </ul>
</li>
       </div>
</nav>  
   
      <div class="container">
        
       @yield('contenuto')
      </div>

    </body>


</html>