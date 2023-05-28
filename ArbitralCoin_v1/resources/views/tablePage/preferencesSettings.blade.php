@extends('layouts.privatePart')

@section('titolo')
ArbitralCoin
@endsection


@section('contenuto')
<form class="form-horizontal" name="userPreferences" method="post" action="{{ route('preferenceSettings.index')}}">
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
<input id="mySubmit" type="submit" value="Save" class="hidden" onclick="event.preventDefault(); checkBook('Save')"/>
</form>
@endsection

