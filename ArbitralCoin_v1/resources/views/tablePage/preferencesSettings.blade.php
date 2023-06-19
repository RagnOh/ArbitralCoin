@extends('layouts.privatePart')

@section('titolo')
ArbitralCoin
@endsection


@section('contenuto')
<div class="exchanges_selection">
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="binanceCheck">
  <label class="form-check-label" for="flexSwitchCheckDefault">Binance</label>
</div>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="krakenCheck">
  <label class="form-check-label" for="flexSwitchCheckDefault">Kraken</label>
</div>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="cryptoCheck">
  <label class="form-check-label" for="flexSwitchCheckDefault">Crypto.com</label>
</div>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="mokupCheck">
  <label class="form-check-label" for="flexSwitchCheckDefault">Mokup</label>
</div>
</div>
<form class="form-horizontal" name="userPreferences" method="post" action="{{ route('preferenceSettings.storeSettings')}}">
@csrf
<div class="form-group">
   <input type="deposito" name="depositAmount" class="form-control" placeholder="Cifra_Deposito"/>
</div>
<div class="form-group">
   <input type="valuta preferita" name="favoriteValute" class="form-control" placeholder="Fav_Valuta"/>
</div>
<div class="form-group">
   <input type="minimo guadagno" name="minGain" class="form-control" placeholder="Min_Guadagno"/>
</div>

<label for="mySubmit" class="btn btn-primary"><i class="bi-check-lg"></i> Save</label>
<input id="mySubmit" type="submit" value="Save" class="hidden" onclick="event.preventDefault(); checkPreferences('Save')"/>
</form>
@endsection

