@extends('layouts.publicPart')

@section('titolo')
ArbitralCoin
@endsection

@section('stile', 'style.css')

@section('contenuto')

 
        


  <div class="site-overview" >
    <div class="firstPreview">
      <img src="../img/blue_adventure.jpg" style="width:100%" >
     


    <div class="content-container col-md-4">
                    <div class="content-words">
                        <h1 class="title">
                          <h2 class="motto" style="font-size: 4vw;"> Save Time/ </h2>
                          <h3 class="motto" style="font-size: 4vw;"> Earn more. </h3>
                          <h4 class="motto" style="font-size: 1.5vw;"> Le migliori opportunità davanti a te </h4>
                        </h1>
                        
                    </div>
                   
    </div>
</div>
  </div>

  <div class="what_site_do row">
  <div class="col-lg-8 col-md-6 col-sm-6 col-6">
  <div class="format1">
  <h1 class="info" style="font-size: 2.8vw;"> Confronta i prezzi delle criptovalute sugli exchanges più importanti del mercato
      e cogli  le occasioni di arbitraggio più ghiotte </h1>
</div>

<div class="format2">
  <h1 class="info" style="font-size: 2.8vw;"> Personalizzazione completa dei parmetri di calcolo </h1>
</div>
</div>

<div class="image-info col-lg-4 col-md-6 col-sm-6 col-6">
<img src="../img/stonks.png" style="width:100%" >
</div>
</div>

<div class="supported_exchanges">

<h1 class="intro-exchanges " style="font-size: 2.8vw;"> Supporto agli exchanges più famosi: </h1>

<div class="row">

<div class="loghi col-lg-6 col-md-6 col-sm-6 col-6">
  <p class="exchangeName" style="font-size: 2.8vw;">Kraken</p>
  <p class="exchangeName" style="font-size: 2.8vw;">Binance</p>
  
  <p class="exchangeName" style="font-size: 2.8vw;">Crypto.com</p>
</div>

<div class="loghi col-lg-6 col-md-6 col-sm-6 col-6" style="margin-top:3vw">
<img src="../img/Kraken-logo.png" style="width:30%" >
<img src="../img/Binance-logo.png" style="width:40%"  >
<img src="../img/Cryptocom-logo.png" style="width:30%"  >
</div>
</div> 
</div>

<div class="col-lg-4 mb-5 mb-lg-0 pricing" >
        <div class="bg-white p-5 price-table rounded-lg shadow" style="margin-top: 2em" style="margin-bottom: 2em">
          <h1 class="h6 text-uppercase font-weight-bold mb-4">Standard</h1>
          <h2 class="h1 font-weight-bold">€50<span class="text-small font-weight-normal ml-2">/ month</span></h2>

          <div class="custom-separator  my-4 mx-auto bg-primary"></div>

          <ul class="list-unstyled my-5 text-small text-left font-weight-normal">
            <li class="mb-3">
              <i class="fa fa-check mr-2 text-primary"></i> Live data</li>
            <li class="mb-3">
              <i class="fa fa-check mr-2 text-primary"></i> 3 different exchanges</li>
            <li class="mb-3">
              <i class="fa fa-check mr-2 text-primary"></i> Full personalization</li>
            
          </ul>
          <a href="{{ route('user.registration')}}" class="btn btn-primary btn-block p-2 shadow rounded-pill">Subscribe now!</a>
        </div>
      </div>



@endsection