@extends('layouts.privatePart')

@section('titolo')
ArbitralCoin
@endsection


@section('contenuto')

<form class="form-horizontal" name="userPreferences" method="post" action="{{ route('preferenceSettings.storeSettings')}}">
@csrf
<div class="exchanges_selection">
<div class="form-check form-switch">
<label>

                    <input
                        type="checkbox" class="form-check-input" name="Binance" id="flexSwitchCheckDefault" checked data-toggle="toggle" data-height="60" data-width="100"
                        data-on="<i class='fa-solid fa-trophy fa-beat'></i> Ranked"
                        data-off="<i class='fa-solid fa-dumbbell'></i> Training" class="px-3 py-2"
                        onchange="document.getElementById('cb').style.display = this.checked ? 'none' : 'block'"
                    />
                    Binance
                </label>
</div>
<div class="form-check form-switch">
<label>

                    <input
                        type="checkbox" class="form-check-input" name="Kraken" id="flexSwitchCheckDefault" checked data-toggle="toggle" data-height="60" data-width="100"
                        data-on="<i class='fa-solid fa-trophy fa-beat'></i> Ranked"
                        data-off="<i class='fa-solid fa-dumbbell'></i> Training" class="px-3 py-2"
                        onchange="document.getElementById('cb').style.display = this.checked ? 'none' : 'block'"
                    />
                    Kraken
                </label>
</div>
<div class="form-check form-switch">
<label>

                    <input
                        type="checkbox" class="form-check-input" name="Crypto" id="flexSwitchCheckDefault" checked data-toggle="toggle" data-height="60" data-width="100"
                        data-on="<i class='fa-solid fa-trophy fa-beat'></i> Ranked"
                        data-off="<i class='fa-solid fa-dumbbell'></i> Training" class="px-3 py-2"
                        onchange="document.getElementById('cb').style.display = this.checked ? 'none' : 'block'"
                    />
                    Crypto
                </label>
</div>
<div class="form-check form-switch">
<label>

                    <input
                        type="checkbox" class="form-check-input" name="Mockup" id="flexSwitchCheckDefault" checked data-toggle="toggle" data-height="60" data-width="100"
                        data-on="<i class='fa-solid fa-trophy fa-beat'></i> Ranked"
                        data-off="<i class='fa-solid fa-dumbbell'></i> Training" class="px-3 py-2"
                        onchange="document.getElementById('cb').style.display = this.checked ? 'none' : 'block'"
                    />
                    Mockup
                </label>
</div>

</div>
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

