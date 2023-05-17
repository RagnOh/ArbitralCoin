@extends('layouts.privatePart')

@section('titolo')
ArbitralCoin
@endsection

@section('navBar')
<nav class="navbar bg-body-tertiary">
    <div class="container-fluid">
         <b class="navbar-brand" >
           <!--<img src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">-->
           @yield('titolo')
         </b>
         <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Nome
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
    </div>
</nav>
@endsection

@section('tabella')
<table class="table table-striped table-hover table-responsive" 
            style="width:100%">
            <col width='20%'>
            <col width='20%'>
            <col width='20%'>
            <col width='10%'>
            <thead>
                <tr>
                    <th>Pair</th>
                    <th>Binance</th>
                    <th>Kraken</th>
                    <th>Crypto.com</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
            @foreach($pairs_list as $pair)
                    <tr>
                        
                        
                        <td>{{ $pair[0]}}</td>
                        <td>{{ $pair[2]}}</td>
                        <td>{{ $pair[1]}}</td>
                        <td>{{ $pair[3]}}</td>
                        
                        
                        
                        
                            
                        
                    </tr>
                    @endforeach
               
            </tbody>
        </table>

@endsection
